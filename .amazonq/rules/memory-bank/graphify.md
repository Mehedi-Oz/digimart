# graphify (Knowledge Graph)

Maps project (code, docs, PDFs, images) into a knowledge graph. Query instead of grep. **Token savings:** ~71x fewer tokens per query vs reading files.

**If `graphify-out/` exists:**

- `graphify-out/GRAPH_REPORT.md` — god nodes, connections, questions
- `graphify-out/graph.html` — interactive browser query
- `graphify-out/graph.json` — structured queries

**Build/update:**

```bash
/graphify .                    # Build current folder
/graphify . --update           # Re-extract changed files
/graphify . --wiki             # Generate markdown wiki
```

**Query:**

```bash
/graphify query "what connects auth to kyc?"
/graphify path "ProfileController" "FileUpload"
/graphify explain "NotificationService"
```

**Docs:** https://graphify.dev
