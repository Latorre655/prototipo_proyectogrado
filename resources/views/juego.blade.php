<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Juego RPG</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            width: 100%;
            height: 100%;
            background: #000;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #unity-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #unity-canvas {
            width: 100%;
            height: 100%;
            aspect-ratio: 16 / 9;
            max-width: calc(100vh * 16 / 9);
            max-height: calc(100vw * 9 / 16);
        }
    </style>
</head>
<body>
    <div id="unity-container">
        <canvas id="unity-canvas"></canvas>
    </div>
    <script src="/game/Build/game.loader.js"></script>
    <script>
        createUnityInstance(document.querySelector("#unity-canvas"), {
            dataUrl: "/game/Build/game.data",
            frameworkUrl: "/game/Build/game.framework.js",
            codeUrl: "/game/Build/game.wasm",
            streamingAssetsUrl: "/game/StreamingAssets",
            companyName: "DefaultCompany",
            productName: "ProyectoLaravel",
            productVersion: "1.0",
        }).then(function(unityInstance) {
            document.querySelector("#unity-canvas").focus();
        }).catch(function(message) {
            console.error("Error:", message);
        });
    </script>
</body>
</html>