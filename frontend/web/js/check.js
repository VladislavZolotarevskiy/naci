/*

 * To change this license header, choose License Headers in Project Properties.

* To change this template file, choose Tools | Templates

* and open the template in the editor.

*/

var status = 1;

$('#incidentsteps-no_send').change(function() {

    status++;

    if (status % 2 === 0){

        alert('Рассылка выполнена не будет!');

    }

});
