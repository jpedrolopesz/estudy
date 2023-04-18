import * as linkify from "linkifyjs"
import linkifyHtml from "linkify-html"

export function useLinkify() {
  function linkifyText(text) {
    return linkifyHtml(text, {
      target: "_blank",
      rel: "nofollow noopener",
      className: "underline text-link-500",
      ignoreTags: ["script", "style"],
      truncate: 30,
    })
  }

  return {
    linkifyText,
  }
}
