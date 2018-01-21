// pages/map/map.js
const app = getApp();
Page({
  /**
   * 页面的初始数据
   */
  data: {
    controls: [{
      id: 1,
      iconPath: '/img/1.png',
      position: {
        left:270,
        top: 20,
        width: 30,
        height: 30
      },
      clickable: true
    }]
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var marker = wx.getStorageSync('markers')
    console.log(marker)
    var markers = [];
    var citysrc = {
      "报刊亭": "baoting",
      "面包甜点":"mianbao",
      "冷饮店": "lengyin",
      "小吃快餐": "xiaochi",
      "超市": "chaoshi",
      "农贸市场": "cai",
      "邮局": "youju",
      "中国电信营业厅": "dianxin",
      "中国移动营业厅": "yidong",
      "中国联通营业厅": "liantong",
      "洗衣店": "xiyi",
      "美容美发": "meirong",
      "KTV": "KTV",
      "酒吧": "jiuba",
      "网吧": "wangba",
      "加油站": "jiayouzhan",
      "洗车场": "xiche",
      "博物馆": "bowuguan",
      "科技馆": "keji",
      "图书馆": "tushu",
      "美术馆": "meishu",
      "大学": "daxue",
      "中学": "zhongxue",
      "小学": "xiaoxue",
      "中国银行": "zhongguo",
      "建设银行": "jianshe",
      "农业银行": "nongye",
      "上海银行": "shanghai",
      "住宅小区": "xiaoqu",
      "别墅": "bieshu",
      "服务区": "fuwuqu",
      "公共厕所": "gongce",
      "公用电话": "gongyongdianhua",
      "公交车站":"gongjiaochezhan",
      "地铁站": "ditiezhan",
      "火车站": "huochezhan",
      "长途汽车站": "changtu",
      "药房药店": "yaofang",
      "综合医院": "yiyuan",
      "长途汽车站": "changtu",
      "酒店宾馆": "jiudian"      
    };
    //循环取出符合map组件的marker数据
    var obj = {};
    for (var i in marker) {
      var cur = marker[i];
      var str = cur.category ? cur.category.split(":").pop() : "";
      if (citysrc[str]) {
        obj.iconPath = "/img/" + citysrc[str] + ".png";
      } else {
        obj.iconPath = "/img/8.png"; 
      }
      obj = {
        id: i,
        latitude: cur.location.lat,
        longitude: cur.location.lng,
        title: cur.title,
        width: "40",
        height: "40",
        label: { content: cur.title, color: "#1AAD19" },
        address: "距离：" + cur._distance + "米"
      };
      markers.push(obj);
    }
    var curloc = wx.getStorageSync('curloc')

    this.setData({
      latitude: curloc.latitude,
      longitude: curloc.longitude,
      markers: markers
    })
  },
  //点击地图图标
  markertap: function (e) {
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
  //跳转--添加地标
  navto: function () {
    wx.navigateTo({
      url: '/pages/addnew/addnew',
    })
  }
})