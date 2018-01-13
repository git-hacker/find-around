
// pages/vice/vice.js
Page({
  startHandel: function () {
    console.log("开始")
    wx.startRecord({
      success: function (res) {
        var tempFilePath = res.tempFilePath
        console.log(res.tempFilePath)
        wx.uploadFile({
          url: 'http://www.suzwgt.com/index.php?s=/Admin/Test/wxupload', //仅为示例，非真实的接口地址
          filePath: tempFilePath,
          name: 'viceo',
          success: function (res) {
            console.log(res);
            var data = JSON.parse(res.data)
            //do something
            if (data.code == "00000") {
              wx.showModal({
                title: '提示',
                content: data.text
              })
            } else {
              wx.showToast({
                title: data.desc
              })
            }
            console.log(data)
          }
        })
      },
      fail: function (res) {
        //录音失败
      }
    })
  },
  endHandle: function () {
    console.log("结束")
    //结束录音  
    wx.stopRecord()
  }
})






// pages/vice/vice.js
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

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },
  startHandel: function () {
    console.log("开始")
    recorderManager.start()
  },
  endHandle: function () {
    console.log("结束")
    //结束录音  
    recorderManager.stop()
  }
})