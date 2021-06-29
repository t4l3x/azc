function template(name,phone_numbers) {
    let  numbers =loadNumbers(phone_numbers);

    let template = `
       <div class="row">
                <div class="col-md-12 category">
                    <h3>${name} (${phone_numbers['_meta']['totalCount']})<i style="float: right;"class="fa fa-close close_box"></i></h3>
                </div>
                <div  class="col-md-10 col-md-offset-2 col-xs-12 number_list ${name}">
                       ${numbers}
                </div>
                <div style="text-align: center;margin-top: 5px" class="col-md-12 col-xs-12 col-sm-12 col-lg-12 align-items-center">
                   
                    <button data-href="${(phone_numbers['_links']['next'] !== undefined ? phone_numbers['_links']['next']['href'] : '#')}"  style="text-align: center;background: #761c19" class="btn bg-primary load_more ${(phone_numbers['_links']['next'] !== undefined ? '' : 'hidden')}"><i class="fa fa-arrow-circle-down"></i></button>
                </div>
            </div>
    `;

    return template;
}


function loadNumbers(phone_numbers) {
    let  numbers ='';
    for(var i=0; i<phone_numbers['phone-numbers'].length; i++){
        numbers += `<div data-number="${phone_numbers['phone-numbers'][i]['number']}" data-phone_id="${phone_numbers['phone-numbers'][i]['id']}" data-toggle="modal" data-target="#exampleModal"  class="col-md-3 col-xs-6 col-sm-4 phone_number">
                            <a class="phone_number" href="#">(${phone_numbers['phone-numbers'][i]['prefix']}) ${phone_numbers['phone-numbers'][i]['number']} <i class="fa fa"></i></a>
                        </div>`;
    }
    return numbers;

}

$(document).on('click', '.load_more', function (e) {

    let  href = '#';
    console.log($(this).attr('data-href'));
    if($(this).attr('data-href') !== '#'){
        $.ajax({
            url: $(this).attr('data-href'),
            type: 'GET',
            async: false,
            beforeSend: null,
            success:
                function (result, textStatus, xhr) {

                    for (var key in result) {
                        $('.'+key).append(loadNumbers(result[key]));
                        if(result[key]['_links']['next'] !== undefined){
                            href = result[key]['_links']['next']['href'];
                        }
                    }

                }
        });
        $(this).attr('data-href',href);
    }else{
        $(this).remove();
    }


});

$(document).on('click', '.close_box', function (e) {
    $(e.target).closest('.row').remove();
});
$(document).on('click', '.phone_number', function (e) {
    $('#recipient-name').val($(this).data('number'));
    $('#phone_id').val($(this).data('number_id'));
    $('.mess').html('');
});