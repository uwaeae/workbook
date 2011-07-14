<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($customer, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($customer, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <li class="sf_admin_action_addstore">
      <?php echo link_to(__('Filiale Hinzufügen', array(), 'messages'), 'customer/addStore?id='.$customer->getId(), array()) ?>
    </li>
  </ul>
</td>
