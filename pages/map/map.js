// pages/map/map.js
const app = getApp();
var curloc = wx.getStorageSync('curloc')
Page({

  /**
   * 页面的初始数据
   */
  data: {
    latitude: curloc.latitude,
    longitude: curloc.longitude
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var marker = wx.getStorageSync('markers')
    console.log(marker)
    var markers = [];
    for (var i in marker){
      var cur = marker[i];
      var obj = {
        id: i,
        latitude: cur.location.lat,
        longitude: cur.location.lng,
        title: cur.title,
        width: "40",
        height: "40",
        label: { content: cur.title, color:"#1AAD19"},
        address: "距离："+cur._distance+"米"
      };
      obj.iconPath = "/img/2.png";
      markers.push(obj);
    }
    this.setData({
      markers: markers
    })
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
  markertap:function(e){
    var idx = e.markerId;
    var obj = this.data.markers[idx];
    console.log(obj);
    wx.openLocation({
      name: obj['title'],
      address: obj['address'],
      latitude: obj.latitude,
      longitude: obj.longitude,
    })
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  },
  navto:function(){
    wx.navigateTo({
      url: '/pages/addnew/addnew',
    })
  }
})