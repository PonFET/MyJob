<?php 
    require_once(VIEWS_PATH . "header.php");
    include_once(VIEWS_PATH . "nav-bar.php");

?>

    <main class="py-5">
        <section id="listado" class="mb-5">
            <div class="container">
                <h1 class="mb-4">Postulaciones a Ofertas Laborales</h1>
            </div>
        </section>
        <br>
            <?php foreach ($offerList as $offer) { ?>

                <section id="listado" class="mb-5">
                    <div class="container">
                        <h3 class="mb-4"><?php echo $offer->getOfferDescription(); ?></h3>

                        <table class="table bg-light-alpha table-striped">
                            <thead>
                                <th>Nombre Completo</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Número Telefónico</th>
                            </thead>
                            <tbody>
                                <?php foreach($jxaList as $jxa) {
                                foreach ($studentList as $row) {                                    
                                    if($jxa['offerId'] == $offer->getOfferId() && $jxa['accountId'] == $row['accountId']) {
                                ?>

                            <tr>
                                <td><?php echo $student->getLastName() . ', ' . $student->getFirstName(); ?></td>
                                <td><?php echo $student->getDni();  ?></td>
                                <td>$<?php echo $student->getEmail(); ?></td>
                                <td>$<?php echo $student->getPhoneNumber(); ?></td>
                            </tr>
            
            <?php } } } } ?>