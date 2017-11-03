// pages/index/index.js
var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    hello:"nihao",
    latitude:"",
    longitude:"",
    shoplist:"",
    nowlist:"",
    scale:16,
    mylist:"",
    index:"0",
  },
  mapbindChange(e){
    console.log(e);
  },
  // 转发
  onShareAppMessage: function (res) {
    if (res.from === 'button') {
      // 来自页面内转发按钮
      console.log(res.target)
    }
    return {
      title: '众享通赢',
      path: '/pages/index/index',
      success: function (res) {
        console.log("ooook")
      },
      fail: function (res) {
        // 转发失败
      }
    }
  },
  regionchange(e) {
    console.log(e);
  },
  bindchange(e){  
    var that=this;
    this.setData({
      index: e.detail.value
    })
    // 获取商家列表
    wx.request({
      url: app.globalData.myurl + "/Api/Shop/shopList", //仅为示例，并非真实的接口地址
      data: {
        lat: that.data.latitude,
        lnt: that.data.longitude,
        p: 1,
        class_id: e.detail.value
      },
      header: {
        'content-type': 'application/json'
      },
      success: function (res2) {
        console.log(res2.data.data)
        var newarr = [];
        var mydata = res2.data.data;
        for (var i = 0; i < mydata.length; i++) {
          var newobj = {
            id: i,
            class_name: mydata[i].class_name,
            latitude: mydata[i].lat,
            longitude: mydata[i].lnt,
            iconPath: '/img/' +mydata[i].class_id+'.png',
            width: "45",
            height: "45",
            name: mydata[i].shop_name,
            address: mydata[i].address,
            label: { color: "#F75E99", fontSize: "10px", content: mydata[i].shop_name, x: -20, y: 0 }
          }
          newarr.push(newobj);
        }
        that.setData({
          shoplist: newarr
        })
      }
    })
   
  },
  markertap(e) {
    console.log(e.markerId)
    var i = e.markerId
    var shoplist = this.data.shoplist;
    console.log(shoplist)
        wx.openLocation({
          latitude: +shoplist[i].latitude,
          longitude: +shoplist[i].longitude,
          name: shoplist[i].name,
          address: shoplist[i].address,
          scale: 18,
          success:function(){
          }
        })
  },
  controltap(e) {
  
  },
  onLoad: function () {
    var that = this;
    wx.getLocation({
      type: 'wgs84',
      success: function (res) {
        that.setData({
          latitude: res.latitude,
          longitude: res.longitude
        })
        console.log(res.latitude)
        console.log(res.longitude)
        // 获取商家分类
        wx.request({
          url: app.globalData.myurl +'/Api/Shop/classList', //仅为示例，并非真实的接口地址
          header: {
            'content-type': 'application/json'
          },
          success: function (res) {
            var classarr = res.data.data;
            classarr.unshift({"name":"全部"});
            that.setData({
              mylist: classarr
            })
            console.log(that.data.mylist)
          }
        })
       
        // 获取商家列表
        wx.request({
          url: app.globalData.myurl+"/Api/Shop/shopList", //仅为示例，并非真实的接口地址
          data: {
            lat: res.latitude,
            lnt:res.longitude,
            p:1
          },
          header: {
            'content-type': 'application/json'
          },
          success: function (res2) {
            console.log(res2.data.data)
            var newarr=[]
            var mydata = res2.data.data;
            for (var i = 0; i <mydata.length ;i++){
                var newobj={
                  id:i,
                  class_name: mydata[i].class_name,
                  latitude: mydata[i].lat,
                  longitude: mydata[i].lnt,
                  iconPath:'/img/'+mydata[i].class_id+'.png',
                  width:"45",
                  height:"45",
                  name: mydata[i].shop_name,
                  address: mydata[i].address,
                  label: { color:"#F75E99",fontSize: "10px", content: mydata[i].shop_name,x:-20,y:5}
                }
                newarr.push(newobj);
            }
            that.setData({
              shoplist: newarr
            })

          }
        })

      }
    })


  }
})
