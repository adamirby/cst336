<?php
    session_start();
    include 'inc/header.php';
?>
  
  
  <div class='container'>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse">
          Advanced Search &nbsp;<i class="glyphicon glyphicon-search" aria-hidden='true'></i>
      </button>
      
      <div class="collapse" id="searchCollapse">
          <div class="card card-body">
              <div class='form' id='shopSearchForm'>
                  <div class='form-group'>
                      <span class='titleSearch'>Title:</span>
    
                      <div class='input-group'>
                          <input type='text' id='title' name='title' class='form-control' placeholder='Search Title'/>
                          <br /><br />
                      </div>
                      
                      <span class='descriptionSearch'>Description:</span>
                      <div class='input-group'>
                          <input type='text' id='description' name='description' class='form-control' placeholder='Search Description'/>
                          <br />
                      </div>
                      
                      <span class="Price">Price Range:</span>
                      <div class="input-group col-xs-2">
                        <span class="input-group-addon">Max $</span>
                        <input type="number" min="0" max="1000" class="form-control currency">
                      </div>
                      <br />
                      <div class="input-group col-xs-2">
                        <span class="input-group-addon">Min $</span>
                        <input type="number" min="0" max="1000" class="form-control currency">
                      </div>
                      
                      <br />
                      
                      <span class="Order">Order By:</span>
                      <div class="input-group">
                          <input type="checkbox" id="orderTitle" name="orderTitle">
                          <label for="orderTitle">Title</label>
                          <input type="checkbox" id="orderPrice" name="orderPrice">
                          <label for="orderPrice">Price</label>
                          <input type="checkbox" id="orderAsc" name="orderAsc">
                          <label for="orderAsc">Ascending?</label>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class='btn-group'>
              <button type='button' id='loginSubmit' class='btn btn-default' aria-label='Login'>Submit</button>
          </div>
      </div>
      
      <br /><br />
    
    <?php 
        if(isset($_POST['searchVal']) and $_POST['searchVal'] != ''){
            searchProduct($_POST['searchVal']);
        }else{
          displayAllProducts(); 
        }
    ?>
      
  </div>





<?php
    include 'inc/footer.php';
?>