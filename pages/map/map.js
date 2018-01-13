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
    //循环取出符合map组件的marker数据
    for (var i in marker) {
      var cur = marker[i];
      var obj = {
        id: i,
        latitude: cur.location.lat,
        longitude: cur.location.lng,
        title: cur.title,
        width: "40",
        height: "40",
        label: { content: cur.title, color: "#1AAD19" },
        address: "距离：" + cur._distance + "米"
      };
      if (cur.category.indexOf("报刊亭") != -1) {
        obj.iconPath = "/img/baoting.png";
      } else if (cur.category.indexOf("面包甜点") != -1) {
        obj.iconPath = "/img/mianbao.png";
      } else if (cur.category.indexOf("冷饮店") != -1) {
        obj.iconPath = "/img/lengyin.png";
      } else if (cur.category.indexOf("小吃快餐") != -1) {
        obj.iconPath = "/img/xiaochi.png";
      } else if (cur.category.indexOf("超市") != -1) {
        obj.iconPath = "/img/chaoshi.png";
      } else if (cur.category.indexOf("农贸市场") != -1) {
        obj.iconPath = "/img/cai.png";
      } else if (cur.category.indexOf("邮局") != -1) {
        obj.iconPath = "/img/youju.png";
      } else if (cur.category.indexOf("中国电信营业厅") != -1) {
        obj.iconPath = "/img/dianxin.png";
      } else if (cur.category.indexOf("中国移动营业厅") != -1) {
        obj.iconPath = "/img/dianxin.png";
      } else if (cur.category.indexOf("中国联通营业厅") != -1) {
        obj.iconPath = "/img/liantong.png";
      } else if (cur.category.indexOf("洗衣店") != -1) {
        obj.iconPath = "/img/xiyi.png";
      } else if (cur.category.indexOf("美容美发") != -1) {
        obj.iconPath = "/img/meirong.png";
      } else if (cur.category.indexOf("KTV") != -1) {
        obj.iconPath = "/img/KTV.png";
      } else if (cur.category.indexOf("酒吧") != -1) {
        obj.iconPath = "/img/jiuba.png";
      } else if (cur.category.indexOf("网吧") != -1) {
        obj.iconPath = "/img/wangba.png";
      } else if (cur.category.indexOf("加油站") != -1) {
        obj.iconPath = "/img/jiayouzhan.png";
      } else if (cur.category.indexOf("洗车场") != -1) {
        obj.iconPath = "/img/xiche.png";
      } else if (cur.category.indexOf("博物馆") != -1) {
        obj.iconPath = "/img/bowuguan.png";
      } else if (cur.category.indexOf("科技馆") != -1) {
        obj.iconPath = "/img/keji.png";
      } else if (cur.category.indexOf("图书馆") != -1) {
        obj.iconPath = "/img/tushu.png";
      } else if (cur.category.indexOf("美术馆") != -1) {
        obj.iconPath = "/img/meishu.png";
      } else if (cur.category.indexOf("美术馆") != -1) {
        obj.iconPath = "/img/meishu.png";
      } else if (cur.category.indexOf("大学") != -1) {
        obj.iconPath = "/img/daxue.png";
      } else if (cur.category.indexOf("中学") != -1) {
        obj.iconPath = "/img/zhongxue.png";
      } else if (cur.category.indexOf("小学") != -1) {
        obj.iconPath = "/img/xiaoxue.png";
      } else if (cur.category.indexOf("中国银行") != -1) {
        obj.iconPath = "/img/zhongguo.png";
      } else if (cur.category.indexOf("建设银行") != -1) {
        obj.iconPath = "/img/jianshe.png";
      } else if (cur.category.indexOf("农业银行") != -1) {
        obj.iconPath = "/img/nongye.png";
      } else if (cur.category.indexOf("上海银行") != -1) {
        obj.iconPath = "/img/shanghai.png";
      } else if (cur.category.indexOf("住宅小区") != -1) {
        obj.iconPath = "/img/xiaoqu.png";
      } else if (cur.category.indexOf("别墅") != -1) {
        obj.iconPath = "/img/bieshu.png";
      } else if (cur.category.indexOf("服务区") != -1) {
        obj.iconPath = "/img/fuwuqu.png";
      } else if (cur.category.indexOf("公共厕所") != -1) {
        obj.iconPath = "/img/gongce.png";
      } else if (cur.category.indexOf("公用电话") != -1) {
        obj.iconPath = "/img/gongyongdianhua.png";
      } else if (cur.category.indexOf("公交车站") != -1) {
        obj.iconPath = "/img/gongjiaochezhan.png";
      } else if (cur.category.indexOf("地铁站") != -1) {
        obj.iconPath = "/img/ditiezhan.png";
      } else if (cur.category.indexOf("火车站") != -1) {
        obj.iconPath = "/img/huochezhan.png";
      } else if (cur.category.indexOf("长途汽车站") != -1) {
        obj.iconPath = "/img/changtu.png";
      } else if (cur.category.indexOf("药房药店") != -1) {
        obj.iconPath = "/img/yaofang.png";
      } else if (cur.category.indexOf("综合医院") != -1) {
        obj.iconPath = "/img/yiyuan.png";
      } else if (cur.category.indexOf("长途汽车站") != -1) {
        obj.iconPath = "/img/changtu.png";
      } else if (cur.category.indexOf("酒店宾馆") != -1) {
        obj.iconPath = "/img/jiudian.png";
      }

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