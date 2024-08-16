<form method="POST" action="index.php?p=booking">
    <div class="container">
        <div class="row">
            <div class="col-md-12 book-form-left-w3layouts">
                <h2>Availability Search</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <label>Check In Date:</label>
                        <div class="form-group input-group">
                            <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any"
                                data-link-format="yyyy-mm-dd" name="arrival" id="date_pickerfrom"
                                value="<?php echo isset($_POST['arrival']) ? $_POST['arrival'] : date('m/d/Y'); ?>"
                                readonly="true" class="date_pickerfrom input-sm form-control">
                            <span class="input-group-btn">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label>Check Out Date:</label>
                        <div class="form-group input-group">
                            <input type="text" data-date="" data-date-format="yyyy-mm-dd" data-link-field="any"
                                data-link-format="yyyy-mm-dd" name="departure" id="date_pickerto"
                                value="<?php echo isset($_POST['departure']) ? $_POST['departure'] : date('m/d/Y'); ?>"
                                readonly="true" class="date_pickerto form-control  input-sm">
                            <span class="input-group-btn">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Accommodation:</label>
                        <div class="form-group input-group">
                            <?php
                            $accomodation = new Accomodation();
                            $cur = $accomodation->listOfaccomodation();
                            ?>
                            <select class="form-control input-sm" name="accomodation" id="person">
                                <?php foreach ($cur as $result) { ?>
                                <option value="<?php echo $result->ACCOMODATION; ?>">
                                    <?php echo $result->ACCOMODATION; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label>Persons:</label>
                        <div class="form-group input-group">
                            <select class="form-control input-sm" name="person" id="person">
                                <?php
                                $sql = "SELECT distinct(`NUMPERSON`) as 'NumberPerson' FROM `tblroom`";
                                $mydb->setQuery($sql);
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $result) {
                                    echo '<option value=' . $result->NumberPerson . '>' . $result->NumberPerson .
                                        '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-4">
                        <label>&nbsp;</label>
                        <div class="form-group input-group">
                            <button class="btn btn-primary" name="checkAvail" type="submit" id="checkAvail">
                                Check Availability
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>


