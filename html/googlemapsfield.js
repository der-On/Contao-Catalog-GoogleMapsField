function GoogleMapsField(container,latfield,lonfield,zoomfield) {
    var _this = this;
    this.minAddressLength = 5;

    this.container = $(container);
    this.latfield = $(latfield);
    this.lonfield = $(lonfield);
    this.zoomfield = $(zoomfield);

    this.map = new google.maps.Map(document.getElementById(container),{
        scrollwheel: false,
        disableDefaultUI: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(parseFloat(this.latfield.get('value')),parseFloat(this.lonfield.get('value'))),
        zoom: parseInt(this.zoomfield.get('value'))
    });

    this.marker = new google.maps.Marker({
        clickable: false,
        draggable: true,
        position: this.map.getCenter(),
        map: this.map
    });

    google.maps.event.addListener(this.marker,'dragend',function(){
        _this.updateLatLonFields();
    });

    google.maps.event.addListener(this.map,'zoom_changed',function(){
       _this.zoomfield.set('value',_this.map.getZoom());
    });

    this.addressfield = $(container+'_address');
    this.addresssubmit = $(container+'_address_submit');

    this.geocoder = new google.maps.Geocoder();

    this.addresssubmit.addEvent('click',function(){
        var address = _this.addressfield.get('value');
        if(address.length>_this.minAddressLength) {
            _this.geocoder.geocode({
                address: address,
                location: _this.map.getCenter()
            },function(results, status){
                if (status == google.maps.GeocoderStatus.OK) {
                    _this.map.setCenter(results[0].geometry.location);
                    _this.marker.setPosition(results[0].geometry.location);
                    _this.updateLatLonFields();
                }
            });
        }
    });

    this.updateLatLonFields = function()
    {
        var pos = _this.marker.getPosition();
        _this.latfield.set('value',pos.lat());
        _this.lonfield.set('value',pos.lng());
    }
};