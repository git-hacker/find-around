// pages/vice/vice.js
var QQMapWX = require('./qqmap-wx-jssdk.min.js');
var qqmapsdk, timeout;
const app = getApp();
var page, time;
const recorderManager = wx.getRecorderManager()
recorderManager.onStart(() => {

})
//录音停止函数
recorderManager.onStop((res) => {
  console.log('recorder stop', res)
  const { tempFilePath } = res
  wx.showLoading({
    title: '等待识别',
  })
  wx.uploadFile({
    url: app.d.hostUrl + '/Api/Index/wxupload', //仅为示例，非真实的接口地址
    filePath: tempFilePath,
    name: 'viceo',
    success: function (res) {
      console.log(res);
      wx.hideLoading();
      if (res.data == "") {
        wx.showToast({
          title: '结果为空！',
        })
        return;
      }
      var data = JSON.parse(res.data)
      //do something
      if (data.code == "00000") {
        //识别成功,提示识别结果
        wx.showToast({
          title: data.data.text,
        })
        //调用查询函数
        page.search(data.data.text);
      } else {
        wx.showToast({
          title: data.desc
        })
      }
      console.log(data)
    }
  })
})

Page({
  /**
   * 页面的初始数据
   */
  data: {
    // 实例化API核心类
    mapkey: "AJ3BZ-EPVCQ-NEY5U-G5H5V-2THSH-XFFI4",
    curcity: "天津",
    text: "按住我",
    showcontext: false,
    press: false,
    index0: -1,
    textval: 10,
    show: true,
    val: '',
    dis: [
      {
        txt: '1公里',
        id: 1000
      },
      {
        txt: '2公里',
        id: 2000
      },
      {
        txt: '3公里',
        id: 3000
      },
      {
        txt: '5公里',
        id: 5000
      }
    ],
    index1: 1000
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    page = that;
    qqmapsdk = new QQMapWX({
      key: this.data.mapkey
    })
    if (!this.data.curcity || !this.data.latitude || !this.data.longitude) {
      wx.getLocation({
        success: function (res1) {
          that.setCur(res1);
        },
      })
    }
    //请求热门搜索和历史记录
    //回调延迟 ，有时为空
    var intval = setInterval(function () {
      var uid = app.d.userId;
      if (uid != undefined && uid != "" && uid > 0) {
        clearInterval(intval);
        that.loadindex(uid);
      }
    }, 500);
  },
  onShow: function () {
    var uid = app.d.userId;
    if (uid != undefined && uid != "" && uid > 0) {
      this.loadindex(uid);
    }
    var val = wx.getStorageSync("val");
    this.setData({
      val: val
    })
  },
  //加载热门搜索和历史记录
  loadindex: function (uid) {
    var that = this;
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/Index/index',
      method: "post",
      data: {
        uid: uid
      },
      success: function (res) {
        if (res.statusCode == 200) {
          var keyhis = res.data.data;
          that.setData({
            keyhis: keyhis[0],
            keyre: keyhis[1]
          })
          console.log(res.data);
        }
      }
    })
  },
  //历史记录--点击事件
  histap: function (e) {
    var val = e.currentTarget.dataset.keyword;
    if (val && val != "") {
      this.search(val);
    }
  },
  //删除历史记录
  removehis: function (e) {
    var val = e.currentTarget.dataset.keyword;
    var index = e.currentTarget.dataset.index;
    var uid = app.d.userId;
    wx.showModal({
      title: '提醒',
      content: '确定要删除该项历史记录吗？',
      success: function (res) {
        if (res.confirm && val && val != "") {
          console.log('用户点击确定');
          wx.request({
            header: {
              'content-type': 'application/x-www-form-urlencoded'
            },
            url: app.d.hostUrl + '/Api/Index/removehis',
            method: "post",
            data: {
              uid: uid,
              keyword: val
            },
            success: function (res) {
              if (res.statusCode == 200) {
                var data = res.data;
                wx.showToast({
                  title: data.message,
                })
                var keyhis = this.data.keyhis;
                console.log(index,"index");
                keyhis.splice(index, 1);
                this.setData({
                  keyhis: keyhis
                })
                console.log(res.data);
              }
            }.bind(this)
          })
        }
      }.bind(this)
    })

  },
  //搜索框数据双向绑定
  inputblur: function () {
    this.setData({
      showcontext: false
    })
  },
  inputfocus: function () {
    if (this.data.keywos && this.data.keywos.length > 0) {
      this.setData({
        showcontext: true
      })
    }
  },
  /**
   * callinput
   * 输入即时响应
  */
  callinput: function (e) {
    var val = e.detail.value;
    this.setData({
      val: val
    })
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      this.getKeywords(val);
    }.bind(this), 500);
  },
  /**
   * 关键词提醒
   * **/
  getKeywords: function (val) {
    var that = this;
    if (!val) {
      that.setData({
        keywos: [],
        showcontext: false
      })
      return;
    }
    //调用微信自动补全方法
    qqmapsdk.search({
      keyword: val,
      location: {
        latitude: this.data.latitude,
        longitude: this.data.longitude
      },
      address_format: 'short',
      success: function (res) {
        console.log("搜索结果", res);
        //此处 关键词 提示 索引
        if (res.status == 0 && res.count > 0) {
          that.setData({
            keywos: res.data,
            showcontext: true
          })
        }
      }
    })
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    return {
      title: 'Find周边',
      desc: '找你所需，就用Find周边!',
      path: '/pages/vice/vice'
    }
  },
  //按下按钮--录音
  startHandel: function () {
    console.log("开始")
    this.setData({
      text: "录音中"
    })
    recorderManager.start({
      duration: 10000
    })
    this.setData({
      show: true,
      textval: 10
    });
    time = setInterval(this.interval, 1000);
  },
  //松开按钮
  endHandle: function () {
    console.log("结束")
    //结束录音  
    this.setData({
      text: "按住我",
      show: true,
      textval: 0
    });
    //触发录音停止
    recorderManager.stop()
  },
  //定时器
  interval: function () {
    console.log(this.data.textval)
    var curval = this.data.textval - 1;
    if (curval <= 0) {
      clearInterval(time)
      this.setData({
        show: true,
        textval: 0
      });
      recorderManager.stop()
    } else {
      this.setData({
        show: false,
        textval: curval
      });
    }
  },
  //键盘输入后确认--搜索关键词
  keyconfirm: function (e) {
    var val = e.detail.value;
    if (val && val != "") {
      this.search(val);
    }
  },
  //getData  
  //输入提示框点击事件--获取自动补全对应的数据
  getData: function (e) {
    console.log(e);
    var index = e.currentTarget.dataset.index;
    this.setData({
      index0: index
    })
    var keywos = this.data.keywos;
    if (keywos[index]) {
      var loc = keywos[index];
      wx.openLocation({
        name: loc['title'],
        address: loc['address'],
        latitude: loc.location.lat,
        longitude: loc.location.lng
      })
    }
  },
  // 修改当前定位位置
  chosecueloc: function () {
    var that = this;
    wx.chooseLocation({
      success: function (res) {
        console.log("当前选择位置", res)
        that.setCur(res);
      }
    })
  },
  //设置中心位置
  setCur: function (res1) {
    var that = this;
    qqmapsdk.reverseGeocoder({
      get_poi: 1,
      location: {
        latitude: res1.latitude,
        longitude: res1.longitude
      },
      success: function (res) {
        console.log(res)
        if (res.status == 0) {
          var curcity = "未知";
          if (res.result && res.result.address_component) {
            curcity = res.result.address || res.result.address_component.street || res.result.address_component.district || res.result.address_component.city;
          }
          //保存设置的当前位置
          wx.setStorage({
            key: 'curloc',
            data: res1,
          })
          that.setData({
            curcity: curcity,
            latitude: res1.latitude,
            longitude: res1.longitude
          })
        }
      }
    })
  },
  //查询函数
  getwifi: function () {
    var uid = app.d.userId;
    var latitude = this.data.latitude;
    var longitude = this.data.longitude;
    var distinct = this.data.index1;
    wx.showLoading({
      title: '搜索中',
    })
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/User/getWifi',
      method: "post",
      data: {
        uid: uid,
        latitude: latitude,
        longitude: longitude,
        distinct: distinct
      },
      success: function (res1) {
        var res = res1.data;
        var markers = res.data;
        if (res.flag == "success") {
          var marker = markers.map(function (obj, index) {
            var curobj = {
              id: index,
              title: obj.name + "wifi",
              address: obj.address,
              category: "wifi",
              type: 0,
              location: {
                lat: obj.google_lat,
                lng: obj.google_lon
              },
              _distance: obj.distance
            }
            return curobj;
          });
          wx.setStorageSync("markers", marker);
          wx.navigateTo({
            url: '/pages/map/map'
          })
        } else {
          wx.showModal({
            title: '提示',
            content: distinct + '米内无搜索结果！'
          })
        }
        console.log("接口数据", res1.data)
      },
      complete: function () {
        wx.hideLoading();
      }
    })
  },
  //查询函数
  search: function (keyword) {
    var uid = app.d.userId;
    var latitude = this.data.latitude;
    var longitude = this.data.longitude;
    var distinct = this.data.index1;
    wx.setStorageSync("val", keyword);
    wx.showLoading({
      title: '搜索中',
    })
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/Index/search',
      method: "post",
      data: {
        uid: uid,
        keyword: keyword,
        latitude: latitude,
        longitude: longitude,
        distinct: distinct
      },
      success: function (res1) {
        var res = res1.data;
        if (res.status == 0 && res.count > 0) {
          wx.setStorageSync("markers", res.data);
          wx.navigateTo({
            url: '/pages/map/map'
          })
        } else {
          wx.showModal({
            title: '提示',
            content: distinct + '米内无搜索结果！'
          })
        }
        console.log("接口数据", res1.data)
      },
      complete: function () {
        wx.hideLoading();
      }
    })
  },
  //选择搜索范围
  tog: function (e) {
    var idx = e.currentTarget.dataset.in;
    this.setData({
      index1: idx
    })
  },
  //清除搜索框
  clear: function () {
    var val = '';
    this.setData({
      val: val,
      showcontext: false,
      keywos: []
    })
  },
  blurarea: function () {
    this.setData({
      showcontext: false,
      keywos: []
    })
  }
})