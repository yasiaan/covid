<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>INSEA - Inscription en ligne</title>
        <style>
            body{
                font-family:"Trebuchet MS", sans-serif;
            }
            nav{
                position: fixed;
                top:0.2px;
                height: 10%;
                background: linear-gradient(0.25turn, white, white, rgb(50, 146, 103), white, white, white, rgb(50, 146, 103), white, white);
                border:1px solid rgb(3, 146, 103);
                box-shadow: 3px 3px rgb(3, 146, 103);
                border-radius:3px;
                width:98%;
                padding:1px;
            }
            #royaume_ar{
                position:absolute;
                height:90%;
                right:0px;
            }
            #royaume_fr{
                position:absolute;
                height:90%;
                left:0px;
            }
            #logo{
                margin-left:47.5%;
            }
            nav a:hover img{
                width:9%;
            }
            div{
                width:90%;
                margin-left:10%;
                margin-top: 7.5em;
            }
            .titre{
                text-align:center;
                margin: 0px;
                margin-right:11%;
            }
            #error{
                color:red;
                background-color:rgb(255,0,0,0.15);
                border:0.4px solid red;
                box-shadow: 1px 1px red;
            }
            h3{
                width:30%;
                margin-left:30%;
                color:rgb(3, 146, 103);
                background-color:rgb(0,255,0,0.1);
                border:0.4px solid rgb(3, 146, 103);
                box-shadow: 1px 1px rgb(3, 146, 103);
                border-radius:4px;
                text-align:center;
            }
            .confirm{
                width:40%;
                margin-left:30%;
            }
            .connexion{
                width:42%;
                margin-left: 24%;
                text-align:center;
                margin-top:0;
                border-right:0.4px solid rgb(3, 146, 103);
                border-bottom:0.4px solid rgb(3, 146, 103);
                box-shadow: 1px 2px rgb(3, 146, 103);
                border-radius:10px;
            }
            table{
                width:90%;
                margin-bottom: 5%;
            }
            thead td{
                background-color:rgb(3, 146, 103);
                color:white;
                text-align: center;
            }
            tbody td a{
                text-decoration:none;
                color:rgb(3, 146, 103);
            }
            tbody td a:hover{
                text-decoration:underline;
            }
            td{
                border:0.4px solid rgb(3, 146, 103);
                box-shadow: 1px 1px rgb(3, 146, 103);
                border-radius:4px;
                padding:4px;
            }
            #photo_profile{
                border:0px solid rgb(3, 146, 103);
                box-shadow: 0px 0px rgb(3, 146, 103);
                width: 2em;
            }
            .photo_profile{
                border:3px solid rgb(3, 146, 103);
                border-radius: 50%;
            }
            #first{
                border-top:0px;
                border-left:0px;
            }
            label, p{
                margin-left:9%;
                font-weight: bold;
                margin-top:4%;
            }
            input, select{
                border: 0px;
                box-shadow: 2.5px 2px lightgray;
                border-radius:6px;
                margin-top:4%;
                margin-bottom:4%;
            }
            input[type="submit"],input[type="reset"],input[type="button"]{
                background-color:rgb(3, 146, 103);
                color:white;
                width:7em;
                height:2em;
                margin-left:46%;
                margin-top:0.5%;
                margin-bottom:0.5%;
            }
            .btnInsAnn{
                margin-left:37%;
            }
            input[type="submit"]:hover,input[type="reset"]:hover,input[type="button"]:hover{
                background-color:green;
                margin-left:45%;
                width:9em;
                height:3em;
            }
            input[type="file"]{
                margin-left:9%;
            }
            #profile{
                border:3px solid rgb(3, 146, 103);
                border-radius:50%;
                margin-left:30%;
                margin-top:2%;
            }
            .fin{
                border:0px;
                box-shadow:0px 0px;
            }
            .fichier{
                border-radius:4px;
                margin-top:1%;
                margin-bottom:1%;
                margin-right:4%;
                margin-left:44%;
                width:10%;
            }
            footer{
                position: fixed;
                bottom:0px;
                width: 100%;
                color:rgb(3, 146, 103);
                background: linear-gradient(0.25turn, white,  rgb(50, 146, 103), white ,  rgb(50, 146, 103), white);
                border-top:1px solid rgb(3, 146, 103);
                text-align:center;
                margin-top:2%;
            }
            footer h5{
                margin-top: 1px;
                margin-bottom: 1px;
            }
        </style>
        <link rel="icon" href="../images/INSEA_logo.png">
    </head>
    <body>
        <nav>
            <img src="../images/royaume.jpg" width="8%" height="15%" id="royaume_fr">
            <a href="http://www.insea.ac.ma/" target="_blank" title="INSEA">
                <img src="../images/INSEA_logo.png" width=5% height="100%" id="logo">
            </a>
            <img src="../images/royaume2.jpg" width="8%" height="15%" id="royaume_ar">
        </nav>
