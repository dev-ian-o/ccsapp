<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../lib/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../lib/fonts/css/font-awesome.min.css">
    <style type="text/css">

      .loader{
            font-size: 30px;
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 100;
        
        }
      .animated {
          animation-duration: .5s;
          animation-iteration-count: infinite;
          animation-timing-function: linear;
          -webkit-animation-duration: .5s;
          -webkit-animation-iteration-count: infinite;
          -webkit-animation-timing-function: linear;

      }

      .animated.infinite {
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
      }

      @-webkit-keyframes rotateIn {
         from { -webkit-transform: rotate(0deg); }
          to { -webkit-transform: rotate(360deg); }
      }

      .rotateIn {
        -webkit-animation-name: rotateIn;
        animation-name: rotateIn;
      }
      input[type="checkbox"] {
          -webkit-appearance: checkbox !important;
          width: 20px;
          height: 20px;
        }
        .center{
            text-align: center;
        }
        .container{
            margin-top: 30px;
        }
        .sticky-circle{
            /*background: #000;*/
            position: fixed;
            border-radius: 20px;
            height: 40px;
            width: 40px;
            margin-left: 20px;
        }
        .sticky-circle:hover{
          border: 3px solid #19C3F6;
        }
        .relative{
            position: relative;
        }
        input[type="range"] {
          -webkit-appearance: none !important;
          width: 100%;
          height: 15px;
          background-color: #a3cd99;
          border: 1px solid #97c68b;
          border-radius: 10px;
          margin: auto;
          transition: all 0.3s ease;
        }

        input[type="range"]:hover {
          background-color: #b2d5aa;
        }

        input[type="range"]::-webkit-slider-thumb {
          -webkit-appearance: none !important;
          width: 20px;
          height: 20px;
          background-color: #579e81;
          border-radius: 30px;
          box-shadow: 0px 0px 3px #3c6d59;
          transition: all 0.5s ease;
        }
        input[type="range"]::-webkit-slider-thumb:hover {
          background-color: #457d66;
        }
        input[type="range"]::-webkit-slider-thumb:active {
          box-shadow: 0px 0px 1px #3c6d59;
        }

        input[data-criteria], #talent-input, #presentation-input, #talent-input2, #presentation-input2{
          text-align: center;
          font-family: "Quantico", sans-serif;
          font-size: 14px;
          display: block;
          margin: auto;
          padding: 10px 0px;
          width: 100%;
          color: #579e81;
        }
        .over-time{ font-size: 20px; color: #FC6D98;}
        .mL40{ margin-left: 40px;}
        .mTn30{ margin-top: -30px; }
        .total-score, .total-score2{ font-size: 14px;}
    </style>

  </head>
  
  <body>