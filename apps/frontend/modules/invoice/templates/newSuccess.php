<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php  use_helper('Date');?>

<?php if (isset($job)): ?>
    <table>
        <tr>
            <td>
                <p>
                    <?php echo $job->getStore()->getCustomer()->getCompany() ?>	<br>


                    <?php echo $job->getStore()->getStreet() ?>
                    <br>
                    <?php echo $job->getStore()->getPostcode() ?>

                    <?php echo $job->getStore()->getCity() ?>
                </p>
                <p>
                    <?php echo $job->getDescription() ?>
                </p>

            </td>
            <td>
                Auftragsnummer <?php echo $job->getID() ?> <br>
                <?php echo format_date($job->getStart(),'dd.MM.yyyy HH:mm') ?> -
                <?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?> <br>

            </td>
        </tr>
    </table>
<?php endif ?>

<?php include_partial('form', array('form' => $form,'job'=>$job)) ?>
