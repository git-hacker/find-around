// pages/addnew/addnew.js
const app = getApp();
Page({

  /**
   * 页面的初始数据
   */
  data: {
    // radioItems:[
    //     {name:' cell standard ',value:' 0 ' },
    //     {name:' cell standard ',value:' 1 ',checked:true }
    // ]
    imgUrls:[],
    keyword:"",
    remark:""
  },
  //选择坐标
  getlocation(){
    var that = this;
    wx.chooseLocation({
      success: function(res) {
        that.setData({
          address: res.address + res.name,
          latitude: res.latitude,
          longitude: res.longitude
        })
      }
    })
  },

  // radioChange: function (e) {
  //   console.log('radio发生change事件，携带value值为：', e.detail.value);
  //   var radioItems = this.data.radioItems;
  //   for (var i = 0, len = radioItems.length; i < len; ++i) {
  //     radioItems[i].checked = radioItems[i].value == e.detail.value;
  //   }

  //   this.setData({
  //     radioItems: radioItems
  //   });
  // },
  //实现输入关键词的双向数据绑定
  keyinput: function( e ){
    var keyword = e.detail.value;
    if (keyword != this.data.keyword){
      this.setData({
        keyword: keyword
      })
    }
  },
  //实现备注信息的双向数据绑定
  remarkinput: function( e ){
    var remark = e.detail.value;
    if (remark != this.data.remark) {
      this.setData({
        remark: remark
      })
    }
  },
  //确定--提交信息
  showTopTips(){
    var keyword = this.data.keyword;
    var lat = this.data.latitude;
    var lnt = this.data.longitude;
    var address = this.data.address;
    var photo = this.data.imgUrls.join(",");
    var remark = this.data.remark;
    wx.request({
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      url: app.d.hostUrl + '/Api/Index/addMarker',
      method: "post",
      data: {
        uid: app.d.userId,
        keyword: keyword,
        lat: lat,
        lnt: lnt,
        address: address,
        photo: photo,
        remark: remark
      },
      success: function (res) {
        if (res.statusCode == 200) {
          wx.showToast({
            title: res.data.message,
          })
          if (res.data.flag == "success"){
            setTimeout(function(){
              wx.navigateTo({
                url: '/pages/vice/vice',
              })
            },1000)
          }
        }
      }
    })

    wx.navigateBack()
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
        wx.showLoading({
          title: '图片上传中'
        });
        wx.uploadFile({
          url: app.d.hostUrl + '/Api/Index/picupload',
          filePath: files[0],
          name: 'pic',
          success: function (res) {
            var data = res.data;
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