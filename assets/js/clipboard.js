function copyClipboard(button, target) {
    const oldTitle = button.dataset['originalTitle'];
    let copied = false;

    target.select();
    target.setSelectionRange(0, target.value.length);

    if (document.queryCommandSupported('copy')) {
        try {
            if (document.execCommand('copy')) {
                target.blur();
                window.getSelection().removeAllRanges();
                copied = true;
            }
        } catch (ex) {
            console.error('Unable to copy to clipboard: ' + ex);
        }
    }

    const copiedMessages = button.dataset['copiedMessages'];

    if ($.fn.tooltip && copiedMessages) {
        $(button).attr('data-original-title', copiedMessages.split('|')[copied ? 0 : 1]).tooltip('show');
        $(button).attr('data-original-title', oldTitle === undefined ? '' : oldTitle);
    }
}

document.querySelectorAll('[data-copy-target]').forEach(function (el) {
    el.addEventListener('click', function (ev) {
        ev.preventDefault();

        const target = el.dataset['copyTarget'];

        copyClipboard(el, target === 'self' ? el : document.getElementById(target));
    });
});
