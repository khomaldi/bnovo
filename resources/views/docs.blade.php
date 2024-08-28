<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="SwaggerUI"/>
    <title>API Docs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui.css"/>
    <style>
        html, body {
            margin: 0;
        }
    </style>
</head>
<body>
<div id="swagger-ui"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-bundle.js" crossorigin></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.17.14/swagger-ui-standalone-preset.js"
        crossorigin></script>
<script>
    window.onload = () => {
        window.ui = SwaggerUIBundle({
            url: '/docs/manifest',
            dom_id: '#swagger-ui',
            displayRequestDuration: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset,
            ],
            plugins: [
                () => ({
                    statePlugins: {
                        spec: {
                            wrapActions: {
                                executeRequest: oriAction => req => {
                                    if (!req.operation.get("parameters")) {
                                        return oriAction(req)
                                    }

                                    req.operation = req.operation.set("parameters", req.operation.get("parameters").map(param => {
                                        const schema = param.get("schema")
                                        const items = schema.get("items")
                                        if (schema.get("type") === "array" || items != null && Array.isArray(items)) {
                                            return param.set("name", param.get("name") + "[]").set("allowReserved", true)
                                        }
                                        return param
                                    }))
                                    req.spec.paths[req.pathName][req.method].parameters = req.operation.get("parameters").toJS()
                                    for (let locationName in req.parameters) {
                                        if (!req.parameters.hasOwnProperty(locationName)) {
                                            continue
                                        }
                                        if (Array.isArray(req.parameters[locationName])) {
                                            req.parameters[locationName + "[]"] = req.parameters[locationName]
                                            delete req.parameters[locationName]
                                        }
                                    }
                                    return oriAction(req)
                                },
                            },
                        },
                    },
                }),
            ],
            layout: "StandaloneLayout"
        });
    };
</script>
</body>
</html>
