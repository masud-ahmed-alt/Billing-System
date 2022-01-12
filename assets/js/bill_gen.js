var sell = [];
var products = []
$(document).ready(() => {
    var psr_inp = $('#product_sr_inp');
    psr_inp.on("keyup", () => {
        var query = psr_inp.val();
        if (query.length > 0) {
            getProduct(query)
        } else {
            $('#pr_result').html('Please Type Something...')
        }
    })
    load_product_ui();
})

function log(msg) {
    console.log(msg)
}

function add_to_list(id) {
    var html = "";
    var total = 1;
    $.ajax({
        url: 'backend/sell_ajax.php?product_id=' + id,
        type: 'GET',
        dataType: 'JSON',
        success: (res) => {
            log(res[0])
            sell.push(res[0])
            total = res[0][3] * 1
            html += `
                <tr id="trid_${res[0][0]}">
                    <td>${res[0][1]}</td>
                    <td>${res[0][5]}</td>
                    <td style="width: 15%;"><input type="text" class="form-control" min='1' value="1" id=inp_${res[0][0]}></td>
                    <td>${res[0][3]}</td>
                    <td id="total_${res[0][0]}"><input type="hidden" name = "total" id="total" value="${total}">${total}</td>
                    <td>
                        <button type="submit" class="btn btn-danger btn-sm" name="" id="remove_${res[0][0]}" > - </button>
                    </td>
                </tr>
           `;
            $('#pr_list').append(html);



            $(`#inp_${res[0][0]}`).on('keyup', () => {
                var qnt = Number($(`#inp_${res[0][0]}`).val());
                var uprice = res[0][3];
                total = qnt * uprice;
                //console.log(total);
                $(`#total_${res[0][0]}`).text(total);
                var nowTotal = Number($('#tamount').text())+total;
                //updateTotal(nowTotal)

            })


            var gamt = 0;
            $(`#total_${res[0][0]}`).each(function () {
                var amt = Number($('#total').val());
                gamt = gamt + amt;
              //  updateTotal(gamt);
                
            });



            $(`#remove_${res[0][0]}`).on('click', () => {
                $(`#trid_${res[0][0]}`).html("")
            })
        }, error: (err) => {
            log(err)
        }


    })



}

function updateTotal(value){
   // $('#tamount').text(value);
}

function getProduct(query) {
    $.ajax({
        url: 'backend/sell_ajax.php?query=' + query,
        type: 'GET',
        dataType: 'JSON',
        success: (res) => {
            if (res.length > 0) {
                var html = `
            
            <tr class="text-center">
                <th>Name</th>
                <th>Desc</th>
                <th> Action</th>
            </tr>
            `
                for (var i = 0; i < res.length; i++) {
                    html += `
                <tr class="text-center">
                    <td>${res[i][1]}</td>
                    <td>${res[i][5]}</td>
                    <td> <button class="btn btn-info btn-sm" type="button" name="button" onclick="add_to_list(${res[i][0]})"> > </button></td>
                </tr>
                `;

                }

                $('#pr_result').html(html);
            } else {
                $('#pr_result').html(`No Result found with  "${query}"`);
            }

        },
        error: (err) => {
            log(err)
        }
    })


}

function load_product_ui() {
    for (var i = 0; i < sell.length; i++) {

    }
}