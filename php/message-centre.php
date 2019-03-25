<?php
    include("../include/header.php");
?>
<script src="../js/message-centre.js"></script> 

<div class="content-container">
    <div class="content-wrap">
        <span class="form-title">
            Message Centre
        </span>
        <div class="group-list inner-content-wrap">
            <div class="upper-content-wrap">
                <button class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#modal">Create new message</button>
            </div>
            <ul class="list-group" id="messages">
            <!--
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
                <li class="list-group-item">
                    [Message Title]
                    <div class="float-r">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </div>
                </li>
            -->
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-left">
                <h4 class="modal-title w-100 font-weight-bold">Create Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <p id="bad-user" class="text-danger font-weight-bold d-none">User does not exist!</p>
                <p id="bad-subject" class="text-danger font-weight-bold d-none">Must include text in the message subject!</p>
                <p id="bad-body" class="text-danger font-weight-bold d-none">Must include text in the message body!</p>
                <div class="md-form mb-1">
                    <label for="to" class="font-weight-bold">Send to:</label>
                    <input type="email" id="to" class="form-control">
                </div>
                <div class="md-form mb-1">
                    <label for="subject" class="font-weight-bold">Subject:</label>
                    <input type="text" id="subject" class="form-control">
                </div>
                <div class="md-form mb-1">
                    <label for="body" class="font-weight-bold">Message:</label>
                    <textarea id="body" rows="10" class="form-control"></textarea>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-right">
                <button id="submit-message" class="btn btn-success">Send</button>
            </div>
        </div>
    </div>
</div>

<?php
    include("../include/footer.php");
?>