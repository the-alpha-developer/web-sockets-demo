Echo.private(`events`)
    .listen('MyEvent', (e) => {
        console.log(e);
    });
