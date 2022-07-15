/** @jsx h */
import { h } from "preact";
import { PageProps } from "$fresh/server.ts";

export default function About(props: PageProps) {
  return <div>About {props.params.name}</div>;
}
