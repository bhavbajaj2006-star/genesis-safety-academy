// Lightweight WYSIWYG editor — no external libraries.
// Turns any <textarea data-rich-editor> into a toolbar + editable box,
// and keeps the original textarea in sync so the form still submits its HTML value normally.
(function () {
  function makeToolbarButton(label, title, onClick) {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'rich-editor-btn';
    btn.title = title;
    btn.innerHTML = label;
    btn.addEventListener('click', onClick);
    return btn;
  }

  function initEditor(textarea) {
    const wrap = document.createElement('div');
    wrap.className = 'rich-editor';

    const toolbar = document.createElement('div');
    toolbar.className = 'rich-editor-toolbar';

    const editable = document.createElement('div');
    editable.className = 'rich-editor-content';
    editable.contentEditable = 'true';
    editable.innerHTML = textarea.value || '<p></p>';

    function exec(cmd, value) {
      document.execCommand(cmd, false, value || null);
      editable.focus();
      sync();
    }

    function sync() {
      textarea.value = editable.innerHTML;
    }

    const buttons = [
      ['B', 'Bold', () => exec('bold')],
      ['I', 'Italic', () => exec('italic')],
      ['U', 'Underline', () => exec('underline')],
      ['H3', 'Heading', () => exec('formatBlock', 'H3')],
      ['P', 'Paragraph', () => exec('formatBlock', 'P')],
      ['• List', 'Bullet list', () => exec('insertUnorderedList')],
      ['1. List', 'Numbered list', () => exec('insertOrderedList')],
      ['Link', 'Insert link', () => {
        const url = prompt('Link URL (e.g. enquiry.html or https://...)');
        if (url) exec('createLink', url);
      }],
      ['Clear', 'Clear formatting', () => exec('removeFormat')],
    ];
    buttons.forEach(([label, title, fn]) => toolbar.appendChild(makeToolbarButton(label, title, fn)));

    editable.addEventListener('input', sync);
    editable.addEventListener('blur', sync);

    wrap.appendChild(toolbar);
    wrap.appendChild(editable);

    textarea.style.display = 'none';
    textarea.parentNode.insertBefore(wrap, textarea);

    // Keep the textarea in sync right before the form submits, in case blur didn't fire.
    const form = textarea.closest('form');
    if (form) form.addEventListener('submit', sync);
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('textarea[data-rich-editor]').forEach(initEditor);
  });
})();
