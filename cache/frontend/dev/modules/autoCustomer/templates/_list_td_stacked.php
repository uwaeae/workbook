<td colspan="6">
  <?php echo __('%%id%% - %%company%% - %%logo%% - %%url%% - %%number%% - %%headoffice%%', array('%%id%%' => link_to($customer->getId(), 'customer_edit', $customer), '%%company%%' => $customer->getCompany(), '%%logo%%' => $customer->getLogo(), '%%url%%' => $customer->getUrl(), '%%number%%' => $customer->getNumber(), '%%headoffice%%' => $customer->getHeadoffice()), 'messages') ?>
</td>
