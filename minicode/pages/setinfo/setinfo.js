// pages/setinfo/setinfo.js
var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    radioItems:[
      { value:1,name:"男"},
      { value:2,name:"女"}
    ]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var user = app.d.userinfo;
    console.log(app.d, user);
    this.setData({
      uid: user.ID,
      headurl: user.headurl,
      name: user.name,
      nickname: user.nickname,
      num: user.num,
      sex: user.sex,
      birth: user.birth || '',
      tel: user.tel
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  }, 
  radioChange:function(e){
    console.log(e);
    var sex = e.detail.value;
    this.setData({
      sex: sex
    })
  },
  bindDateChange: function (e) {
    console.log('picker发送选择改变，携带值为', e.detail.value)
    this.setData({
      birth: e.detail.value
    })
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
  
  },
  keyinput: function (e) {
    var name = e.detail.value;
    if (name != this.data.name) {
      this.setData({
        name: name
      })
    }
  },
  //实现备注信息的双向数据绑定
  remarkinput: function (e) {
    var tel = e.detail.value;
    if (tel != this.data.tel) {
      this.setData({
        tel: tel
      })
    }
  },
  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },
  showTopTips: function() {
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/User/saveInfo',
      method: "post",
      data: {
        uid: this.data.uid,
        name: this.data.name,
        sex: this.data.sex,
        birth: this.data.birth,
        tel: this.data.tel
      },
      success: function (res) {
        if (res.statusCode == 200 && res.data.flag == "success") {
          console.log(res.data);
          wx.showToast({
            title: res.data.message,
            duration: 1000,
            success:function(){
              wx.navigateBack({
                delta:1
              })
            }
          })
        }else{
          wx.showToast({
            title: res.data.message
          });
        }
      }
    })
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
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})