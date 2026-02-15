ymaps.ready(init);

function init() {

    var geolocation = ymaps.geolocation,
        myMap = new ymaps.Map('maps', {
            center: [55, 34],
            zoom: 12
        }, {
            searchControlProvider: 'yandex#search'
        });
    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (result) {

        myMap.geoObjects.add(result.geoObjects);

    });
    geolocation.get({
        provider: 'browser',
        mapStateAutoApply: true
    }).then(function (result) {
        var ress = result.geoObjects.get(0).properties._data.metaDataProperty.GeocoderMetaData.Address.Components;

        json = 'checks=' + JSON.stringify(ress);
        console.log(ress);
        var adress = '';
        for (var key in ress) {
            if (ress.hasOwnProperty(key)) {

                if (ress[key].kind == 'locality') {
                    console.log( ress[key]);
                    adress = adress +' ' + ress[key]['name']
                    // $('#town_msg').append(ress[key].name)
                    // $('.gettown').show();

                }
                if (ress[key].kind == 'street') {
                    console.log( ress[key]);
                    adress = adress +' ' + ress[key]['name']
                    // $('#town_msg').append(ress[key].name)
                    // $('.gettown').show();

                }
                if (ress[key].kind == 'house') {
                    console.log( ress[key]);
                    adress = adress +' ' + ress[key]['name']
                    // $('#town_msg').append(ress[key].name)
                    // $('.gettown').show();

                }
                console.log(ress);

                $('#low_name').val(adress).focus()
            }
        }

    })
}