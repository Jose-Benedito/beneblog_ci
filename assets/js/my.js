$(document).ready(function(){
    $(document).on('click', 'view_data', function(){
        var user_id = $(this).attr("id");
        alert(user_id);

    });
});

$(document).ready(function(){
    $('a[data-confirm').click( function(ev){
        var button = $(this).attr("button");
        if(!$('#cofirm-delete').length){
            $('body').append(
            
            <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="dataConfirmOk">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            
            
            
            );




        }
        $('#dataConfirmOk').attr('button', href);
        $('confirm-delete').modal({shown: true});
        return false;
    });

    
   /* $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      }) */

});