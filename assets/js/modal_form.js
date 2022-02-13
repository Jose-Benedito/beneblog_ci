$(document).ready(function(){
    $('.editbtn').on('click', function(){
        $('#visitanteModal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();

          console.log(data);

   
          $('#update_id').val(data[0]);
          $('#nome').val(data[1]);
          $('#funcao').val(data[2]);
          $('#hora_ent').val(data[3]);
          $('#hora_saida').val(data[4]);
    });
});

