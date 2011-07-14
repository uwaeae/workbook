<?php use_javascript('jquery-1.4.4.min.js') ?>

<h1 id="_zuordnung">  Import - Auswahl</h1>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php echo $form->renderFormTag('import/order') ?>
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input id="submit" type="submit" />
      </td>
    </tr>
  </table>
</form>