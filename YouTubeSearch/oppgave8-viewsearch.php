<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Oppgave8 - Video search</title>
  <style media="screen">

    .card-video > h2 {

      height: 55px; 
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .card-video > p {

      overflow: hidden;
      text-overflow: ellipsis; 
    }

    .card-video > img {
      width: 100%;
      border-radius: 50px 20px;
    }


    .card-video {
      flex: 0 0 250px;
      overflow: hidden;
      text-overflow: ellipsis;
      margin: 5px;
      cursor: pointer;
    }

    .container-video-card {
      display: flex;
      flex-wrap: wrap;
    }


    .videoplayer {
      display: none;
      position: fixed;
      margin: 5vh 5vw 5vh 5vw;
      width: 90vw;
      height:90vh;
      left:0;
      top:0;
      z-index: 1;
      background-color: black;
    }



  </style>
</head>
<body>

   <div id="id-container-video-card" class="container-video-card"></div>


<iframe id="videoplayerid" class="videoplayer" width="854" height="480"></iframe>

</body>

<script>


  let isFullscreenVideo = false;

  function populateVideoGrid() {
    fetch("search.php")
        .then(res => { return res.json() })
        .then(res => { 

          res.items.map(item => {

            let cardVideo = document.createElement('div');
            let title = document.createElement('h2');
            let description = document.createElement('p');

            title.innerHTML = item.snippet.title;
            description.innerHTML = item.snippet.description;

            // Use these two badboys to create a videolink
            let etag = item.etag


            let img = new Image;
            img.src = item.snippet.thumbnails.medium.url;

            cardVideo.classList.add('card-video')
            cardVideo.appendChild(title);
            cardVideo.appendChild(img);
            cardVideo.appendChild(description);
            document.getElementById('id-container-video-card').appendChild(cardVideo);

            cardVideo.addEventListener('click', e => {

              let videoplayer = document.getElementById('videoplayerid');

              if (!isFullscreenVideo) {


                // src="https://www.youtube.com/embed/w2iZEbp5A44"
                let videoId = item.id.videoId;
                videoplayer.src = `https://www.youtube.com/embed/${videoId}`;


                setTimeout( () => { isFullscreenVideo = true; }, 1000)

                videoplayer.style.display = 'block'
              }
            })
          });

        })
        .catch(err => console.log(err))

  }

  window.addEventListener('load', e => {

    populateVideoGrid()

    document.body.addEventListener('click', e => {

      let videoplayer = document.getElementById('videoplayerid');

      if (isFullscreenVideo) {
        videoplayer.style.display = 'none';
        isFullscreenVideo = false;
      }

    })

  })

</script>

</html>