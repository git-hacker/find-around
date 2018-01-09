// pages/vice/vice.js
var QQMapWX = require('./qqmap-wx-jssdk.min.js');
var qqmapsdk;
const recorderManager = wx.getRecorderManager()
recorderManager.onStart(() => {
  console.log('recorder start')
})
recorderManager.onStop((res) => {
  console.log('recorder stop', res)
  const { tempFilePath } = res
  wx.playVoice({
    filePath: tempFilePath,
  })
  wx.showLoading({
    title: '等待识别',
  })
  wx.uploadFile({
    url: 'http://www.suzwgt.com/index.php?s=/Admin/Test/wxupload', //仅为示例，非真实的接口地址
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
        wx.showModal({
          title: '提示',
          content: data.data.text
        })
        qqmapsdk.search({
          keyword: data.data.text,
          success: function (res) {
            console.log(res);

          }
        }
        )
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
    text:"按住我"
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
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
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },
  /**
   * callinput
   * 输入即时响应
  */
  callinput: function (e) {
    console.log(e)
    var val = e.detail.value;
    qqmapsdk.search({
      keyword: val,
      location: {
        latitude: this.data.latitude,
        longitude: this.data.longitude
      },
      address_format:'short',
      success: function (res) {
        console.log("搜索结果", res);
        //此处 关键词 提示 索引
      }
    })
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },
  startHandel: function () {
    console.log("开始")
    this.setData({
      text:"录音中"
    })
    recorderManager.start()
  },
  endHandle: function () {
    console.log("结束")
    //结束录音  
    this.setData({
      text: "按住我"
    })
    recorderManager.stop()
  },
  chosecueloc:function(){
    //修改当前定位位置
    var that = this;
    wx.chooseLocation({
      success: function(res) {
        console.log("当前选择位置",res)
        that.setCur(res);
      }
    })
  },
  setCur: function (res1){
  //设置中心位置
    var that = this;
    qqmapsdk.reverseGeocoder({
      get_poi: 1,
      location: {
        latitude: res1.latitude,
        longitude: res1.longitude
      },
      success: function (res) {
        console.log("默认", res);
        if (res.status == 0) {
          var curcity = res.result.address_component.district || res.result.address_component.city;
          that.setData({
            curcity: curcity,
            latitude: res1.latitude,
            longitude: res1.longitude
          })
        }
      }
    })
  }
})