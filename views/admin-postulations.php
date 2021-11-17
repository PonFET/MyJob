<?php 
    require_once(VIEWS_PATH . "header.php");
    include_once(VIEWS_PATH . "nav-bar.php");
    
?>

    <main class="py-5">
        <section id="listado" class="mb-5">
            
                <h1 class="mb-4">Postulaciones a Ofertas Laborales</h1>
            
        </section>

        
            
        
        
            <?php foreach ($companiesList as $company) { echo '<h3 class="mb-4">' . $company->getCompanyName() . '</h3>'; ?>
                <?php foreach($offerList as $offer) { $exist = 0; if($offer->getCompanyId() == $company->getCompanyId()) {    ?>
                
                <form action="" onclick="window.open('postulationsPDF')"><!-- FORM PDF open -->
                    

                    <section id="listado" class="mb-5">
                    <div class="container">
                        <hr>
                        <h3 class="mb-4"><?php echo $offer->getOfferDescription(); ?> </h3>
                        <?php 
                              foreach($jxaList as $jxa)
                              {
                                if($jxa['offerId'] == $offer->getOfferId())
                                {
                                    $exist = 1;
                                }
                              }

                              if($exist == 1) {
                        ?>
                            <button type="submit" class="btn btn-warning">Crear PDF de Postulantes</button> <br><br>
                        <?php } elseif($exist == 0){ ?>
                             <br><br>
                        <?php } ?>
                        <h4>Posiciones buscadas:</h4>
                        <?php foreach($offer->getArrayJobPos() as $positionId) {
                                foreach($positionList as $jobPos) {
                                    if($jobPos->getJobPositionId() == $positionId) {
                                        echo "· " . $jobPos->getDescription() . '<br>';
                            } } }   ?>
                        <br><br>
                        <div class="table-responsive">
                        <table class="table col-xl bg-light-alpha table-striped">
                            <thead>
                                <th>Nombre Completo</th>
                                <th>Carrera</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Número Telefónico</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <?php foreach($jxaList as $jxa) {
                                foreach ($studentList as $student) { 
                                    if($jxa['offerId'] == $offer->getOfferId() && $jxa['accountId'] == $student['accountId']) { 
                                ?>

                            <tr>
                                <td><?php echo $student['student']->getLastName() . ', ' . $student['student']->getFirstName(); ?></td>
                                <td><?php foreach($careerList as $career) { if($career->getCareerId() == $student['student']->getCareerId()) { echo $career->getDescription(); } } ?></td>
                                <td><?php echo $student['student']->getDni();  ?></td>
                                <td><?php echo $student['student']->getEmail(); ?></td>
                                <td><?php echo $student['student']->getPhoneNumber(); ?></td>

                            </form><!-- FORM PDF close -->

                                <td><form action="<?php echo FRONT_ROOT . 'jobOffer/deletePostulation'; ?>">
                                    <input type="hidden" name="offerId" value="<?php echo $offer->getOfferId(); ?>">
                                    <input type="hidden" name="email" value="<?php echo $student['student']->getEmail(); ?>">
                                    <input type="hidden" name="companyName" value="<?php echo $company->getCompanyName(); ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form></td>
                            </tr>

                            <?php } } } } } ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </section>
                            
            
            <?php } ?>

        </main>