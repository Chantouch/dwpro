<div class="modal fade" id="show-contact" tabindex="-1" role="dialog"
     aria-labelledby="myContactLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="panel panel-color panel-pink">
                <div class="panel-heading">
                    <h3 class="panel-title">@{{ fill_contact.name }}</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <!-- List group -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="ti-email m-r-5"></i>Email: @{{ fill_contact.email }}
                    </li>
                    <li class="list-group-item">
                        <i class="ti-mobile m-r-5"></i>Mobile  @{{ fill_contact.phone_number }}
                    </li>
                    <li class="list-group-item">
                        <i class="ti-agenda m-r-5"></i>Position  @{{ fill_contact.position }}
                    </li>
                    <li class="list-group-item">
                        <i class="ti-home m-r-5"></i> Department: @{{ fill_contact.department }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>