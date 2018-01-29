// pages/report/report.js
var app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    imgUrls: []
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

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },
  //实现备注信息的双向数据绑定
  remarkinput: function (e) {
    var content = e.detail.value;
    if (content != this.data.content) {
      this.setData({
        content: content
      })
    }
  },
  //确定--提交信息
  showTopTips() {
    var curloc = wx.getStorageSync("curloc");
    var lat = curloc.latitude;
    var lnt = curloc.longitude;
    var pic = this.data.imgUrls.join(",");
    var content = this.data.content;
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/Report/setReport',
      method: "post",
      data: {
        uid: app.d.userId,
        lat: lat,
        lnt: lnt,
        pic: pic,
        content: content
      },
      success: function (res) {
        if (res.statusCode == 200) {
          wx.showToast({
            title: res.data.message,
            duration: 1000,
            success: function(){
              wx.navigateTo({
                url: '/pages/home/home',
              })
            }
          })
        }
      }
    })
  },
  //图片上传
  choseimg: function () {
    var that = this;
    wx.chooseImage({
      count: 1,
      sizeType: ['compressed'],
      sourceType: ['album', 'camera'],
      success: function (res) {
        // success
        var files = res.tempFilePaths;
        console.log(files);
        wx.showLoading({
          title: '图片上传中'
        });
        wx.uploadFile({
          url: app.d.hostUrl + '/Api/Index/picupload',
          filePath: files[0],
          name: 'pic',
          success: function (res) {
            var data = res.data;
            console.log(data);
            var imgUrls = that.data.imgUrls;
            if (typeof data != 'object') data = JSON.parse(data);
            if (data.flag == "success") {
              imgUrls.push(app.d.hostImg + data.data);
              that.setData({
                imgUrls: imgUrls
              })
            } else {
              wx.showModal({
                title: '错误',
                content: data.message
              })
            }
          }.bind(this),
          complete: function () {
            wx.hideLoading();
          }
        });
      }.bind(this)
    })
  },
  //取消上传
  removeimg: function (e) {
    var idex = e.currentTarget.dataset.index;
    var imgUrls = this.data.imgUrls;
    imgUrls.splice(idex, 1);
    this.setData({
      imgUrls: imgUrls
    })
  }
})