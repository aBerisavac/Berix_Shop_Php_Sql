<?php 
    $getCarouselItemsQuery="SELECT * FROM carousel_pics";
    $prepare = $conn->prepare($getCarouselItemsQuery);
    $prepare->execute();
    $carouselPics=$prepare->fetchAll();
?>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
  <?php foreach($carouselPics as $carouselPic): ?>
    <div class="carousel-item <?php if($carouselPic->id==1) echo('active') ?>">
      <img src="../../assets/images/Carousel/<?=$carouselPic->src?>" class="d-block w-100" alt="<?=$carouselPic->alt?>">
    </div>
    <?php endforeach ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>