<?php
    include("../include/header.php");
    
    date_default_timezone_set('America/Toronto');
?>

<script type="text/javascript" src="../js/account.js"></script>

<div class="content-container">
    <div class="content-wrap">
        <span class="form-title">
            My Account
        </span>
        
        <div class="container-fluid">
            <div class="row">
                <div class="mt-3 col-md-12 card card-inverse bg-light">
                    <div class="card-header ">
                        <h2>Account Details</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="card-body table mb-0">
                            <tr>
                                <td><h4>Username:</h4></td>
                                <td>
                                    <p>
                                        <?php if (!isset($_SESSION['UserName'])) {
                                                    echo "You're not logged in!";
                                                  } else {
                                                    echo  $_SESSION['UserName'];}
                                            ?>
                                    </p>
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td><h4>Email:</h4></td>
                                <td>
                                    <p id="p-email">
                                        <?php if (!isset($_SESSION['Email'])) {
                                                    echo "You're not logged in!";
                                                  } else {
                                                    echo  $_SESSION['Email'];}
                                            ?>
                                    </p>                        
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="input-group col-md-8 ml-auto">
                                            <input type="text" id="email" class="form-control" placeholder="update"> 
                                            <div class="input-group-btn input-group-append">
                                                <button type="submit" name="change-email" id="change-email" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><h4>Affiliation:</h4></td>
                                <td>
                                    <p id="p-affiliation">
                                        <?php if (!isset($_SESSION['Affiliation'])) {
                                                    echo "You don't have an affiliation!";
                                                  } else {
                                                    echo  $_SESSION['Affiliation'];}
                                            ?>
                                    </p>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="input-group col-md-8 ml-auto">
                                            <input type="text" id="affiliation" class="form-control" placeholder="update"> 
                                            <div class="input-group-btn input-group-append">
                                                <button type="submit" name="change-affiliation" id="change-affiliation" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>                               
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mt-3 col-md-12 card card-inverse bg-light">
                    <div class="card-header ">
                        <h2>Your Current Groups</h2>
                    </div>
                    <div class="card-body pt-0">        
                        <ul class="list-group" id="group-list">
                            
                            <!--                       
                              <li class="list-group-item m-1">
                                  [Group Name] - [Class name] - [Admin Status]
                                  <div class="float-r">
                                      <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                                      <button class="btn btn-danger" type="submit">Delete Group</button>
                                  </div>
                              </li>
                              <li class="list-group-item m-1">
                                  [Group Name] - [Class name] - [Admin Status]
                                  <div class="float-r">
                                      <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                                      <button class="btn btn-danger" type="submit">Delete Group</button>
                                  </div>
                              </li>
                              <li class="list-group-item m-1">
                                  [Group Name] - [Class name]
                                  <div class="float-r">
                                      <a class="btn btn-primary" role="button" href="group-schedule-view.php">View Contents</a>
                                      <button class="btn btn-danger" type="submit">Exit Group</button>
                                  </div>
                              </li>                       
                              -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<?php
    include("../include/footer.php");
?>