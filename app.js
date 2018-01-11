//app.js
App({
  d: {
    hostUrl: 'https://mapxcx.kanziqiang.top/index.php',
    hostImg: 'https://mapxcx.kanziqiang.top',
    appId: "wxe900513990933078",
    appKey: "8844c389cef08accd7ea86abfffbfb7e",
    ceshiUrl: 'https://mapxcx.kanziqiang.top/index.php'
  },
  onLaunch: function () {
    //调用API从本地缓存中获取数据
    var that = this;
    // 设备信息
    wx.getSystemInfo({
      success: function (res) {
        that.screenWidth = res.windowWidth;
        that.screenHeight = res.windowHeight;
        that.pixelRatio = res.pixelRatio;
      }
    });
    // wx.showLoading({
    //   title: '登录中！'
    // })
    this.getUserInfo(function (resp,openid) {
      var openid = wx.getStorageSync("onlyid")
      that.loginIn(openid, resp);
    });
  },
  getUserInfo: function (cb) {
    var that = this
    if (this.globalData.userInfo) {
      typeof cb == "function" && cb(this.globalData.userInfo)
    } else {
      //调用登录接口
      wx.login({
        success: function (res) {
          if (res.code) {
            //发起网络请求
            wx.request({
              url: this.d.hostUrl + '/Api/Login/getOpenid',
              data: {
                js_code: res.code
              },
              header: {
                'content-type': 'application/x-www-form-urlencoded'
              },
              method:"POST",
              success: function (res1) {
                var openid = res1.data.openid;
                wx.setStorageSync("onlyid", openid)
                // console.log(res.data.openid)
                wx.getUserInfo({
                  success: function (res) {
                    // console.log(res)
                    that.globalData.userInfo = res.userInfo
                    typeof cb == "function" && cb(that.globalData.userInfo)
                  }
                })
              }
            })
          } else {
            console.log('获取用户登录态失败！' + res.errMsg)
          }
          
        }.bind(this)
      })
    }
  },
  globalData: {
    userInfo: null
  },
  loginIn: function (openid, user) {
    var that = this;
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: this.d.hostUrl + '/Api/Login/authlogin',
      method: "POST",
      data: {
        openid: openid,
        NickName: user.nickName,
        HeadUrl: user.avatarUrl,
        gender: user.gender
      },
      success: function (res) {
        var resp = res.data;
        wx.hideLoading();
        if (resp.status == 1) {
          var info = res.data.arr;
          that.d.userId = info.ID;
          that.d.NickName = info.NickName;
          that.d.HeadUrl = info.HeadUrl;
        } else {
          var err = res.data.err;
          wx.showModal({
            title: '错误提醒',
            content: err
          })
        }
      }
    })
  }
})
