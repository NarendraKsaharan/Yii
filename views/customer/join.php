<?php


$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table table-bordered">
    <table style="width:100%;" class="table-primary">
        <thead class="thead-dark">
            <tr>
                <th>Sr. No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th>Country</th>
                <th>Address</th>
                <th>Pincode</th>
                <th>Job Title</th>
                <th>Company</th>
            </tr>
        </thead>    
        <?php
        $i = 1;
        foreach($customers as $customer){
        ?>
        <tbody class="thead-dark">
            <tr>
                <th><?= $i++ ?></th>
                <th><?= $customer->user->name ?></th>
                <th><?= $customer->user->email ?></th>
                <th><?= $customer->phone ?></th>
                <th><?= $customer->city ?></th>
                <th><?= $customer->country ?></th>
                <th><?= $customer->address ?></th>
                <th><?= $customer->pincode ?></th>
                <th><?= $customer->job_title ?></th>
                <th><?= $customer->company ?></th>
            </tr>
        </tbody>    
        <?php } ?>    
    </table>
</div>