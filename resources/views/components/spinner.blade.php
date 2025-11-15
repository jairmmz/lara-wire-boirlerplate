<div class="dots-container">
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>

    <style>
        .dots-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            height: 100%;
            min-height: 100px;
        }

        .dot {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background-color: #171717;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .dot:nth-child(1) { animation-delay: -0.3s; }
        .dot:nth-child(2) { animation-delay: -0.1s; }
        .dot:nth-child(3) { animation-delay: 0.1s; }

        @keyframes pulse {
            0% {
                transform: scale(0.8);
                background-color: #171717;
                box-shadow: 0 0 0 0 rgba(71, 75, 79, 0.7);
            }
            50% {
                transform: scale(1.2);
                background-color: #000000;
                box-shadow: 0 0 0 10px rgba(178, 212, 252, 0);
            }
            100% {
                transform: scale(0.8);
                background-color: #171717;
                box-shadow: 0 0 0 0 rgba(71, 75, 79, 0.7);
            }
        }
    </style>
</div>
