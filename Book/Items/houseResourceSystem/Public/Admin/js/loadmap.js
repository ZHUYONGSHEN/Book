window.onload = function() {
    init();
}
var geocoder, map, marker = null,
    markersArray = [];
//初始化地图
var init = function() {
        var lat = $("#FLatitude").val();
        var lan = $("#FLongitude").val();
        var center = new qq.maps.LatLng(lat, lan);
        map = new qq.maps.Map(document.getElementById('map_container'), {
            center: center,
            zoom: 15,
        });
        marker = new qq.maps.Marker({
            position: center,
            map: map
        });
        markersArray.push(marker);
        qq.maps.event.addListener(map, 'click', function(event) {
            clearmark();
            var lat = event.latLng.getLat();
            var lng = event.latLng.getLng();
            $("#FLatitude").val(lat);
            $("#FLongitude").val(lng);
            locat(lat, lng);
            codeLatLng(event.latLng);
            var marker = new qq.maps.Marker({
                position: event.latLng,
                map: map
            });
            markersArray.push(marker);
            qq.maps.event.addListener(map, 'click', function(event) {
                marker.setMap(null);
            });
        });
        if ('undefined' != typeof iscode) {
            //地址和经纬度之间进行转换服务
            geocoder = new qq.maps.Geocoder();
            codeLatLng(center);
        }
        geocoder = new qq.maps.Geocoder();
        codeLatLng(center);
    }
    //清除标志
function clearmark() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
}
//根据经纬度获取地址
function codeLatLng(o) {
    var latLng = new qq.maps.LatLng(o.lat, o.lng);
    geocoder.getAddress(latLng);
    geocoder.setComplete(function(result) {
        $("#getAddress").val(result.detail.address);
    });
    geocoder.setError(function() {
        alert("请输入正确的经纬度！！！");
    });
}
//搜索获取经纬度和地址
function codeAddress() {
    console.log(geocoder);
    clearmark();
    var address = $("#soaddress").val();
    //对指定地址进行解析
    geocoder.getLocation(address);
    //设置服务请求成功的回调函数
    geocoder.setComplete(function(result) {
        map.setCenter(result.detail.location);
        marker = new qq.maps.Marker({
            map: map,
            position: result.detail.location
        });
        $("#FLatitude").val(result.detail.location.lat);
        $("#FLongitude").val(result.detail.location.lng);
        $("#getAddress").val(result.detail.address);
        markersArray.push(marker);
    });
    //若服务请求失败，则运行以下函数
    geocoder.setError(function() {
        alert("请输入正确的地址！");
    });
}
//地图定位
function locat(lat, lng) {
    var center = new qq.maps.LatLng(lat, lng);
    map.panTo(center);
}