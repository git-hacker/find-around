// pages/chat/chat.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    "auther":[
      {
        "name":"SoberLi",
        "headimg":"/img/header3.jpeg",
        "level":"运营负责人",
        "phone":"",
        "wxcode":"wxid_sdj324wszjxb"
      },
      {
        "name": "Topqiang",
        "headimg": "/img/header1.jpeg",
        "level": "技术负责人",
        "phone": "",
        "wxcode": "xiaoqiang0672"
      },
      {
        "name": "姚路兰",
        "headimg": "/img/header2.jpeg",
        "level": "UI负责人",
        "phone": "",
        "wxcode": "ks837165706"
      }
      ]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
  
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
  copycode:function(e){
    var code = e.currentTarget.dataset.wx;
    wx.setClipboardData({
      data: code,
      success: function (res) {
        wx.showModal({
          title: '复制成功！',
          showCancel:false,
          content: '返回微信粘贴搜索！'
        })
      }
    })
  },
  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})