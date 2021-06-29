<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\helpers\Html; ?>
    <div class="site-index">
        <div class="container">
            <div class="row">
                <div id="center" class="col-md-8 col-sm-12">
                    <h1 style="text-align: center"> <?=Yii::t('app','Reserve your number')?></h1>
                    <?= Html::beginForm(['/api/phone-numbers/filter'], 'get', ['class' => 'myform']) ?>

                    <div class="col-md-4 col-sm-12 search">
                        <div class="cat">
                            <select name="PhoneNumbersSearch[cat_id]" style="width: auto" name="pref">
                                <option value="">All</option>
                            </select>
                        </div>
                        <div class="code">
                            <select name="PhoneNumbersSearch[operator_id]" style="width: 82px" name="pref">
                                <option value="">All</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12 search">
                        <div class="search-line">
                            <div class="search-dot">
                                <input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum1" size="1" maxlength="1"
                                       onkeyup=" keypr(event,1)">
                            </div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum2" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,2)"></div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum3" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,3)"></div>
                            <div class="search-vacuum"></div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum4" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,4)"></div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum5" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,5)"></div>
                            <div class="search-vacuum"></div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum6" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,6)"></div>
                            <div class="search-dot"><input name="PhoneNumbersSearch[phone][]" pattern="[0-9]*" type="text" id="idnum7" size="1"
                                                           maxlength="1"
                                                           onkeyup=" keypr(event,7)"></div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="group-btn">
                            <button onclick="return resetnums()" class="btn-search"
                                    id="delete"> <?= Yii::t('app', 'RESET') ?></button>
                            <button type="submit" class="btn-search"><?= Yii::t('app', 'SEARCH') ?></button>

                        </div>
                    </div>
                </div>
            </div>
            <?= Html::endForm() ?>


            <div class="index_numbers">

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="map"></div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 style="text-align: center" class="mess"></h3>
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"><?=Yii::t('app','Your Chose')?>:</label>
                                <input  type="hidden" class="form-control" id="phone_id">
                                <input disabled type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Your Phone:</label>
                                <input required pattern="[0-9]*" type="tel" class="form-control" id="recipient-name">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary order">Reserve</button>
                    </div>
                </div>
            </div>
        </div>



    </div>


<?php
$lang = Yii::$app->language;
$this->registerJs(<<< EOT_JS_CODE

    function resetnums() {
        document.getElementById("idnum1").value = '';
        document.getElementById("idnum2").value = '';
        document.getElementById("idnum3").value = '';
        document.getElementById("idnum4").value = '';
        document.getElementById("idnum5").value = '';
        document.getElementById("idnum6").value = '';
        document.getElementById("idnum7").value = '';
        return false;
    }
    function keypr(ev, ind) {
        //48 -0
        //8 -backspace
        //46 delete


        if ((ev.keyCode > 47 && ev.keyCode < 58) || (ev.keyCode > 95 && ev.keyCode < 106)) {
            if (ev.keyCode > 47 && ev.keyCode < 58)
                document.getElementById("idnum" + ind).value = (ev.keyCode - 48);
            else
                document.getElementById("idnum" + ind).value = (ev.keyCode - 96);
            if (ind < 7) {
                document.getElementById("idnum" + (ind + 1)).focus();
            }

        }
        else if (ev.keyCode == 8 || ev.keyCode == 46) {
            document.getElementById("idnum" + ind).value = "";
            if (ind > 1) {
                document.getElementById("idnum" + (ind - 1)).focus();
            }

        }
        else {
            document.getElementById("idnum" + ind).value = "";

        }
        return false;
    }


function initMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: 40.37767, lng: 49.89201}
    });

    setMarkers(map);
}
var beache = [
    ["Bondi Beach", -33.890542, 151.274856, 4],
    ["Coogee Beach", -33.923036, 151.259052, 5],
    ["Cronulla Beach", -34.028249, 151.157507, 3],
    ["Manly Beach", -33.80010128657071, 151.28747820854187, 2],
    ["Maroubra Beach", -33.950198, 151.259302, 1]
];
// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
let locations;
$.ajax({
    url: "/$lang/api/phone-numbers/vendors",
    type: 'GET',
    async: false,
    beforeSend: null,
    success:
        function (result, textStatus, xhr) {
         
           locations = result;
        }
});
var beaches = locations;

function setMarkers(map) {
    // Adds markers to the map.

    // Marker sizes are expressed as a Size of X,Y where the origin of the image
    // (0,0) is located in the top left of the image.

    // Origins, anchor positions and coordinates of the marker increase in the X
    // direction to the right and in the Y direction down.
    var image = {
        url:
            "https://nomre.bakcell.com/content/images/bakcell-marker.png",
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(32, 42),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(0, 32)
    };
    // Shapes define the clickable region of the icon. The type defines an HTML
    // <area> element 'poly' which traces out a polygon as a series of X,Y points.
    // The final coordinate closes the poly by connecting to the first coordinate.
    var shape = {
        coords: [1, 1, 1, 20, 18, 20, 18, 1],
        type: "poly"
    };
    for (var i = 0; i < beaches.length; i++) {
        var beach = beaches[i];
        var marker = new google.maps.Marker({
            position: { lat:  parseFloat(beach['latitude']), lng:  parseFloat(beach['longitude']) },
            map: map,
            icon: image,
            shape: shape,
            title: beach['address'],
            zIndex:  i
        });
    }
}

 $(document).on('submit', '.myform', function () { // changed
            var frm = $(this);
            var check = false;
            $.each($('.myform :input'),function(){
                if($(this).val() !== ''){
                    check = true;
                }
            });
            if(check){
                $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: frm.serialize(),
                        success: function (data) {
                         for (var key in data) {
                            $('.index_numbers').prepend(template(key,data[key]))    
                            }
                        },
                        error: function (data) {
                           
                            console.log('An error occurred.');
                            console.log(data);
                        },
                });
            }else{
                alert('Required');
            }
            return false; // avoid to execute the actual form submission.
  });

$.ajax({
    url: "/$lang/api/phone-numbers/categories",
    type: 'GET',
    async: false,
    beforeSend: null,
    success:
        function (result, textStatus, xhr) {
           for(let i = 0; i < result.length; i++){
                $('.cat select').append('<option value="'+result[i]['id']+'">'+ result[i]['name'] +'</option>');
              
           }    
        }
});

$.ajax({
    url: "/$lang/api/phone-numbers/prefix",
    type: 'GET',
    async: false,
    beforeSend: null,
    success:
        function (result, textStatus, xhr) {
           for(let i = 0; i < result.length; i++){
                $('.code select').append('<option value="'+result[i]['id']+'">'+ result[i]['prefix'] +'</option>');
              
           }    
        }
});

$.ajax({
    url: "/$lang/api/phone-numbers/",
    type: 'GET',
    async: false,
    beforeSend: null,
    success:
        function (result, textStatus, xhr) {
           for (var key in result) {
               $('.index_numbers').append(template(key,result[key]))
                   
            }
        }
});

$(document).on('click', '.order', function (e) {
    $.ajax({
    url: "/$lang/api/phone-numbers/order/",
    type: 'GET',
    async: true,
    beforeSend: null,
    success:
        function (result, textStatus, xhr) {
            $('.mess').html(result['status'])
        }
});
});
EOT_JS_CODE
    , \yii\web\View::POS_END);