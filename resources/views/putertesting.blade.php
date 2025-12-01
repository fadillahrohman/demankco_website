<html>
<body>
    <script src="https://js.puter.com/v2/"></script>
    <div class="flex justify-start">
        <div>
            <h1>Puter Testing</h1>
            <img src="/images/fur.jpg" alt="furry image" width="300">
        </div>
        <div>
            <script>
                puter.ai.chat(`Siapa kamu? `, testMode = false, { model: "gpt-5-nano" }).then(puter.print);
            </script>
        </div>
    </div>
</body>
</html>
