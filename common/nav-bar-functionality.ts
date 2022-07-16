export function ObtainCurrentUrl(req: any, ctx: any) {
  const url = new URL(req.url);
  return url;
}
