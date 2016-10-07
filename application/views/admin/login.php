<?php $this->load->view('admin/templates/header',$data); ?>


<?php $this->load->view('admin/templates/nav',$data); ?>

    <main class="main container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">Users</a></li>
                    <li role="presentation"><a href="#">Posts</a></li>
                    <li role="presentation"><a href="#">My Profile</a></li>
                </ul>
            </div>
            <div class="col-md-9" ng-controller="adminController as ac">
                <user-table
                    users="ac.users"
                    on-modal-show="ac.user = $event.user; ac.user.gender = ac.gender[ac.user.gender]"
                    on-modal-close=""
                ></user-table>
                <edit-user-modal
                    on-user-update="ac.users = $event.users"
                    user="ac.user"
                    gender="ac.gender"
                ></edit-user-modal>
                <edit-user-credentials-modal
                    on-user-update="ac.users = $event.users"
                    user="ac.user"
                ></edit-user-credentials-modal>
                <delete-user-modal
                    user="ac.user"
                    on-user-delete="ac.users = $event.users"
                ></delete-user-modal>
                <add-user-modal
                    user
                    on-user-add="ac.users = $event.users"
                ></add-user-modal>
            </div>

        </div>
    </main>


<?php $this->load->view('admin/templates/footer'); ?>