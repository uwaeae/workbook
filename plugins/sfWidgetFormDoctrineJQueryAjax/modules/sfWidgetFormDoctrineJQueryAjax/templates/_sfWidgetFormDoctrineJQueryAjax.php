<script type="text/javascript">
 
    $(document).ready(function() {
            $("#sfWidgetFormDoctrineJQueryAjax").find(".ajaxResults")load( '<?php echo url_for( "sfWidgetFormDoctrineJQueryAjax/ajax" ); ?>' );
        });
 
</script>
 
<div id="sfWidgetFormDoctrineJQueryAjax">
 
    Hello ...
 
    <div class="ajaxResults"></div>
 
</div>