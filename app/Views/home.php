<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?= base_url("reset.css") ?>">
        <link rel="stylesheet" href="<?= base_url("style.css") ?>">
        <script src="<?= base_url("scripts/header.js") ?>"></script> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home | Antartika</title>
        <style>
        section {
            display: flex;
            gap: 128px;
            align-items: center;
            flex-direction: column;

            margin-top: 15vw;
        }

        h1 {
            font-size: 72pt;
        }

        form {
            width: 100%;
        }

        form input[type=text] {
            position: relative;
            display: block;
            margin: auto;

            width: 85%;
            height: 100%;

            border: none;
            outline: none;

            margin-left: 32pt;
            margin-right: 32pt;
            
            background: none;
            color: #c6d0f5;
        }

        form button {
            position: relative;
            width: 36px;
            height: 36px;
            
            border: none;
            outline: none;

            font-size: 16pt;
        }

        form div {
            display: flex;
            position: relative;

            width: 100%;
            height: 36px;
            border-radius: 15pt;

            background: #303446;
            overflow: clip;
        }

        form div::before {
            content: "🔍 ";
            position: absolute;
            top: 25%;
            left: 12px;
            z-index: 20;
        }

        </style>
    </head>
    <home>
        <header>
            <img id="profileButton"
                src="<?= base_url("/uploads/users/profiles/" . sprintf("%05d.png", session()->get("id"))) ?> " 
                onerror="this.src='<?= base_url("noprof.png") ?>';">
        </header>
        <?= view("parts/header_click") ?>
        <section>
            <h1>Antartika</h1>
            <form action="/app/search">
                <div>
                    <input type="text" name="q" placeholder="Enter app name...">
                    <button>→</button>
                </div>
            </form>
        </section>
    </home>
</html>
