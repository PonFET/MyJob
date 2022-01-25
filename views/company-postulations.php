<?php 
    require_once(VIEWS_PATH . "header.php");
    include_once(VIEWS_PATH . "nav-bar.php");

?>

    <main class="py-5">
        <section id="listado" class="mb-5">
            
                <h1 class="mb-4">Postulaciones a Ofertas Laborales</h1>
            
        </section>
        
            <?php foreach ($offerList as $offer) { ?>

                <section id="listado" class="mb-5">
                    <div class="container">
                        <h3 class="mb-4"><?php echo $offer->getOfferDescription(); ?></h3><br>
                        <h4>Posiciones buscadas:</h4>
                        <?php foreach($offer->getArrayJobPos() as $positionId) {
                                foreach($positionList as $jobPos) {
                                    if($jobPos->getJobPositionId() == $positionId) {
                                        echo "· " . $jobPos->getDescription() . '<br>';
                            } } }   ?>
                        <br><br>

                        <div class="row" style="height:inherit">
                            <div class="col align-self-center">
                                <img src="<?php echo $offer->getOfferImg(); ?>" height="60">
                            </div>
                        </div><br><br>

                        <table class="table bg-light-alpha table-striped">
                            <thead>
                                <th>Nombre Completo</th>
                                <th>Carrera</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Número Telefónico</th>
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
                            </tr>

                            <?php } } } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
                            
            
            <?php } ?>

        </main>