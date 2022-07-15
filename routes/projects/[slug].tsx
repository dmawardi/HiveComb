/** @jsx h */
import { h } from "preact";
import { PageProps } from "$fresh/server.ts";

export default function ProjectPage(props: PageProps) {
  const { slug } = props.params;
  return (
    <main>
      <p>Greetings you are reading: {slug}!</p>
    </main>
  );
}
