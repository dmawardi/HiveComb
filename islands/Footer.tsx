/** @jsx h */
import { h } from "preact";
import { useState } from "preact/hooks";
import { IS_BROWSER } from "$fresh/runtime.ts";

interface FooterProps {
  path: string;
}

export default function Footer({ props }: FooterProps) {
  const path = props.path;
  return (
    <ul class="nav justify-content-center nav-pills">
      <li class="nav-item">
        <a
          class={path == "/" ? "nav-link active" : "nav-link"}
          aria-current="page"
          href="/"
        >
          Home
        </a>
      </li>
      <li class="nav-item">
        <a
          class={path == "/contact" ? "nav-link active" : "nav-link"}
          href="/contact"
        >
          Contact
        </a>
      </li>
      <li class="nav-item">
        <a
          class={path == "/about" ? "nav-link active" : "nav-link"}
          href="/about"
        >
          About
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">
          Portfolio
        </a>
      </li>
    </ul>
  );
}
