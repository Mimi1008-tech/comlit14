$(function () {
  if (
    localStorage.getItem("preview") != null &&
    localStorage.getItem("draft") != null
  ) {
    $("#user").val(localStorage.getItem("user"));
    $("#title").val(localStorage.getItem("title"));
    $("#preview").html(localStorage.getItem("preview"));
    $("#editor").val(localStorage.getItem("draft"));
    $("#article").val(localStorage.getItem("preview"));
  }
  hljs.highlightAll();

  $("#editor").on("input", function (event) {
    marked.use(markedKatex({ throwOnError: false }));
    html = marked.parse(event.target.value);

    localStorage.setItem("user", $("#user").val());
    localStorage.setItem("title", $("#title").val());
    localStorage.setItem("draft", $("#editor").val());
    localStorage.setItem("preview", html);

    $("#preview").html(html);
    $("#article").val(html);

    hljs.highlightAll();
  });
});

const NOT_LF = /\r\n|\r/g,
  REG_INDENT_SPACE = /^([\s\u3000]+)/,
  addEnter = function (e) {
    let start;
    if (!isNaN((start = e.selectionStart))) {
      let value = e.value,
        region_byCaret = value.slice(0, start),
        CRLFs = region_byCaret.match(NOT_LF);

      if (CRLFs) {
        region_byCaret = region_byCaret.replace(NOT_LF, "\n");
        start -= CRLFs.length;
      }

      let region = region_byCaret,
        lines = region.split("\n"),
        n = lines.length - 1,
        spc;

      if (0 === lines[n].length) {
        if ((spc = lines[n - 1].match(REG_INDENT_SPACE))) {
          let s = spc[1];
          e.value = region_byCaret + s + value.slice(start);
          e.selectionStart = e.selectionEnd = start + s.length;
        }
      }
    }
  };

class AutoIndent {
  constructor(target = {}) {
    if (target.nodeName !== "TEXTAREA")
      throw new Error("TEXTAREA ではありません");

    this.target = target;
    this.disabled = false;

    target.addEventListener("keyup", this, false);
  }

  handleEvent({ key }) {
    if (!this.disabled) if ("Enter" === key) addEnter(this.target);
  }

  addEnter() {
    if (!this.disabled) addEnter(this.target);
  }
}

this.AutoIndent = AutoIndent;

new AutoIndent(document.getElementById("editor"));

("use strict");

window.onload = function () {
  const onKeyDown = function (ev) {
    if ((ev.keyCode != 9 && ev.keyCode != 32) || ev.ctrlKey || ev.altKey) {
      return true;
    }
    ev.preventDefault();
    const str = ev.keyCode == 32 ? " " : "\t",
      TABWIDTH = 4,
      CRLF = [13, 10];
    let e = ev.target,
      start = e.selectionStart,
      end = e.selectionEnd,
      sContents = e.value,
      top = e.scrollTop;
    if (start == end || !sContents.includes("\n")) {
      e.setRangeText(str, start, end, "end");
      return;
    }
    if (CRLF.indexOf(sContents.charCodeAt(end - 1)) < 0) {
      for (; end < sContents.length; end++) {
        if (CRLF.indexOf(sContents.charCodeAt(end)) >= 0) {
          break;
        }
      }
    }
    for (; start > 0; start--) {
      if (CRLF.indexOf(sContents.charCodeAt(start - 1)) >= 0) {
        break;
      }
    }
    let v = sContents.substring(start, end).split("\n");
    for (let i = 0; i < v.length; i++) {
      if (v[i] == "") {
        continue;
      }
      if (!ev.shiftKey) {
        //indent
        v[i] = str + v[i];
      } else {
        //unindent
        if (str == "\t") {
          for (let j = 0, c = " "; j < TABWIDTH && c == " "; j++) {
            c = v[i].substring(0, 1);
            if (c == " " || (j == 0 && c == "\t")) {
              v[i] = v[i].substring(1);
            }
          }
        } else if (v[i].substring(0, 1) == " ") {
          v[i] = v[i].substring(1);
        }
      }
    }
    e.setRangeText(v.join("\n"), start, end, "select");
  };

  document.getElementById("editor").addEventListener("keydown", onKeyDown);
};
