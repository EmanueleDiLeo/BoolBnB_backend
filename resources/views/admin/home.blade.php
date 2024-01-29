@extends('layouts.admin')

@section('content')

    <div class="landscape">
        <h1 class="welcome">HOME ADMIN</h1>
        <div class="mountain"></div>
        <div class="mountain mountain-2"></div>
        <div class="mountain mountain-3"></div>
        <div class="sun-container sun-container-1">
        </div>
        <div class="sun-container">
          <div class="sun"></div>
        </div>
        <div class="cloud"></div>
        <div class="cloud cloud-1"></div>
        <div class="sun-container sun-container-reflection">
          <div class="sun"></div>
        </div>
        <div class="light"></div>
        <div class="light light-1"></div>
        <div class="light light-2"></div>
        <div class="light light-3"></div>
        <div class="light light-4"></div>
        <div class="light light-5"></div>
        <div class="light light-6"></div>
        <div class="light light-7"></div>
        <div class="water"></div>
        <div class="splash"></div>
        <div class="splash delay-1"></div>
        <div class="splash delay-2"></div>
        <div class="splash splash-4 delay-2"></div>
        <div class="splash splash-4 delay-3"></div>
        <div class="splash splash-4 delay-4"></div>
        <div class="splash splash-stone delay-3"></div>
        <div class="splash splash-stone splash-4"></div>
        <div class="splash splash-stone splash-5"></div>
        <div class="lotus lotus-1"></div>
        <div class="lotus lotus-2"></div>
        <div class="lotus lotus-3"></div>
        <div class="front">
          <div class="stone"></div>
          <div class="grass"></div>
          <div class="grass grass-1"></div>
          <div class="grass grass-2"></div>
          <div class="reed"></div>
          <div class="reed reed-1"></div>
        </div>
    </div>

    <div class="wrapper">
        <div class="weather">
          <div class="svg">
            <svg version="1.1" id="rainclouds" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               width="297px" height="308.5px" viewBox="0 0 297 308.5" enable-background="new 0 0 297 308.5" xml:space="preserve">
              <g class="weather__raindrops">
                <g class="raindrops--right">
              <path class="weather__raindrops--1" d="M165.5,171.4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.3-19.2,16.8c-2.4,4.6-0.6,10.2,4,12.5
                C157.6,177.7,163.2,176,165.5,171.4L165.5,171.4z M165.5,171.4"/>
              <path class="weather__raindrops--2" d="M200,171.4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.3-19.1,16.8c-2.4,4.6-0.6,10.2,4,12.5
                C192.1,177.7,197.7,176,200,171.4L200,171.4z M200,171.4"/>
              <path class="weather__raindrops--3" d="M224.6,175.4c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.3-19.2,16.8
                C218.3,167.4,220.1,173,224.6,175.4L224.6,175.4z M224.6,175.4"/>
              <path class="weather__raindrops--4" d="M161,209.9c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.2-19.2,16.8
                C154.6,201.9,156.4,207.5,161,209.9L161,209.9z M161,209.9"/>
              <path class="weather__raindrops--5" d="M195.5,209.9c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.2-19.2,16.8
                C189.1,201.9,190.9,207.5,195.5,209.9L195.5,209.9z M195.5,209.9"/>
            </g>
                <g class="raindrops--left">
              <path class="weather__raindrops--6" d="M68.5,205.9c2.4-4.6,2.6-25.3,2.6-25.3S54.4,192.8,52,197.3c-2.4,4.6-0.6,10.2,4,12.5
                C60.6,212.2,66.2,210.4,68.5,205.9L68.5,205.9z M68.5,205.9"/>
              <path class="weather__raindrops--7" d="M103,205.9c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.3-19.1,16.8c-2.4,4.6-0.6,10.2,4,12.5
                C95.1,212.2,100.7,210.4,103,205.9L103,205.9z M103,205.9"/>
              <path class="weather__raindrops--8" d="M127.6,209.9c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.3-19.2,16.8
                C121.3,201.9,123.1,207.5,127.6,209.9L127.6,209.9z M127.6,209.9"/>
              <path class="weather__raindrops--9" d="M64,244.3c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3S62.4,227.2,60,231.8
                C57.6,236.4,59.4,242,64,244.3L64,244.3z M64,244.3"/>
              <path class="weather__raindrops--10" d="M98.5,244.3c4.6,2.4,10.2,0.6,12.5-4c2.4-4.6,2.6-25.3,2.6-25.3s-16.8,12.2-19.2,16.8
                C92.1,236.4,93.9,242,98.5,244.3L98.5,244.3z M98.5,244.3"/>
            </g>
              </g>
              <g class="weather__clouds">

                  <path d="M142.5,127.8c0,0-31.4-6.7-31.4-36.7
                    s26.7-39.9,36.5-39.9s13.3,1.6,13.3,1.6s4.4-36.9,41.2-36.9s41.5,36.4,41.4,39.8c0,3.4,0.2,4.8-0.6,9.2c0,0,5.2-1.7,12.6-1.7
                    c10.8,0,30.1,8,30.1,34s-30.4,30.6-30.4,30.6H142.5z"/>
                  <path d="M46.2,164.7c0,0-31.4-6.7-31.4-36.7
                    s26.7-39.9,36.5-39.9s13.3,1.6,13.3,1.6s4.4-36.9,41.2-36.9s41.5,36.4,41.4,39.8c0,3.4,0.2,4.8-0.6,9.2c0,0,5.2-1.7,12.6-1.7
                    c10.8,0,30.1,8,30.1,34s-30.4,30.6-30.4,30.6H46.2z"/>

              </g>
              <g class="weather__lightning">
                <polygon points="125.436,171.75 111.1,195.781 133.401,190.239 111.1,235.75 145.6,180.6 126.35,185.6 138,171.75
                  "/>
                <polygon points="207.686,144.42 193.35,168.451 215.651,162.909 193.35,208.42 227.85,153.27 208.6,158.27
                  220.249,144.42 "/>
              </g>
            </svg>

          </div>
          <span class="weather__date">New York, NY &#8212; <span id="date"></span></span>
          <h2 class="weather__pretitle">It is Raining.</h2>
          <h1 class="weather__title">You will get wet.</h1>
        </div>



        <div class="row d-flex align-items-center ">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Appartamenti</h5>
                  <p class="card-text">Tieni aggiornati i tuoi appartamenti, attirerà piu clienti!</p>
                  <a href="#" class="btn btn-primary">I tuoi appartamenti</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Appartamenti</h5>
                  <p class="card-text">Se hai piu appartamenti puoi aggiungerli con un click</p>
                  <a href="#" class="btn btn-primary">Aggiungi appartamento</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Messaggi</h5>
                    <p class="card-text">Tieni d'occhio la sezione messaggi, tenersi in contatto con i propri clienti è importante</p>
                    <a href="#" class="btn btn-primary">Visualizza messaggi</a>
                  </div>
                </div>
            </div>

              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Sponsorizzazioni</h5>
                    <p class="card-text">Sponsorizza ora i tuoi appartamenti, i clienti li visualizzeranno come primi risultati</p>
                    <a href="#" class="btn btn-primary">Sponsorizza</a>
                  </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('title')
    | Homepage
@endsection

