String.prototype.replaceArray = function(find, replace) {
    let replaceString = this;
    for (let i = 0; i < find.length; i++) {
        replaceString = replaceString.replace(find[i], replace[i]);
    }
    return replaceString;
};
String.prototype.replaceArrayRegex = function(find, replace) {
    let replaceString = this;
    let regex;
    for (let i = 0; i < find.length; i++) {
        regex = new RegExp(find[i], "g");
        replaceString = replaceString.replace(regex, replace[i]);
    }
    return replaceString;
};
String.prototype.replaceAllArray = function(find, replace) {
    let replaceString = this;
    for (let i = 0; i < find.length; i++) {
        replaceString = replaceString.replaceAll(find[i], replace[i]);
    }
    return replaceString;
};
String.prototype.replaceAllArrayRegex = function(find, replace) {
    let replaceString = this;
    let regex;
    for (let i = 0; i < find.length; i++) {
        regex = new RegExp(find[i], "g");
        replaceString = replaceString.replaceAll(regex, replace[i]);
    }
    return replaceString;
};
function getVideoCover(file, seekTo = 0.0, videoPlayer) {
    return new Promise((resolve, reject) => {
        //let videoPlayer = document.createElement('video');
        videoPlayer.controls = true;
        videoPlayer.setAttribute('src', URL.createObjectURL(file));
        videoPlayer.load();
        videoPlayer.addEventListener('error', (ex) => {
            reject("error when loading video file", ex);
        });
        videoPlayer.addEventListener('loadedmetadata', () => {
            if (videoPlayer.duration < seekTo) {
                reject("video is too short.");
                return;
            }
            setTimeout(() => {
                videoPlayer.currentTime = seekTo;
            }, 200);
            videoPlayer.addEventListener('seeked', () => {
                let canvas = document.createElement("canvas");
                canvas.width = videoPlayer.videoWidth;
                canvas.height = videoPlayer.videoHeight;
                let ctx = canvas.getContext("2d");
                ctx.drawImage(videoPlayer, 0, 0, canvas.width, canvas.height);
                //console.log(ctx.canvas.toDataURL("image/jpeg", 0.75));
                //resolve([videoPlayer, canvas]);
                resolve(ctx.canvas.toDataURL("image/jpeg", 0.75));
            });
        });
    });
}
