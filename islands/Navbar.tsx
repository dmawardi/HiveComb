/** @jsx h */
import { h } from "preact";
import { useState } from "preact/hooks";
import { IS_BROWSER } from "$fresh/runtime.ts";
import { Handlers, PageProps } from "$fresh/server.ts";

interface NavBarProps {
  props: {
    url: string;
  };
}

export default function NavBar({ props }: NavBarProps) {
  const pathName = props.url;

  return (
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">
          HiveComb
        </a>
        {pathName}
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse flex-row-reverse me-4"
          id="navbarNavDropdown"
        >
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class={pathName == "/" ? "nav-link active" : "nav-link"}
                aria-current="page"
                href="/"
              >
                Home
              </a>
            </li>
            <li class="nav-item">
              <a
                class={pathName == "/contact" ? "nav-link active" : "nav-link"}
                href="/contact"
              >
                Contact
              </a>
            </li>
            <li class="nav-item">
              <a
                class={pathName == "/about" ? "nav-link active" : "nav-link"}
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
        </div>
      </div>
    </nav>
  );
}
