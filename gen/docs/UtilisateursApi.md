# UtilisateursApi

All URIs are relative to *http://api.bilemo.com/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**utilisateursGet**](UtilisateursApi.md#utilisateursGet) | **GET** /utilisateurs | Retourne un tableau d&#39;utilisateurs
[**utilisateursPost**](UtilisateursApi.md#utilisateursPost) | **POST** /utilisateurs | Créer un utilisateur
[**utilisateursUserIdDelete**](UtilisateursApi.md#utilisateursUserIdDelete) | **DELETE** /utilisateurs/{userId} | Supprimer un utilisateur
[**utilisateursUserIdGet**](UtilisateursApi.md#utilisateursUserIdGet) | **GET** /utilisateurs/{userId} | Retourne les détails d&#39;un utilisateur
[**utilisateursUserIdPut**](UtilisateursApi.md#utilisateursUserIdPut) | **PUT** /utilisateurs/{userId} | Modifier un utilisateur


<a name="utilisateursGet"></a>
# **utilisateursGet**
> List&lt;Utilisateurs&gt; utilisateursGet()

Retourne un tableau d&#39;utilisateurs

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UtilisateursApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    UtilisateursApi apiInstance = new UtilisateursApi(defaultClient);
    try {
      List<Utilisateurs> result = apiInstance.utilisateursGet();
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling UtilisateursApi#utilisateursGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**List&lt;Utilisateurs&gt;**](Utilisateurs.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Un tableau JSON d&#39;utilisateurs |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

<a name="utilisateursPost"></a>
# **utilisateursPost**
> utilisateursPost(inlineObject)

Créer un utilisateur

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UtilisateursApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    UtilisateursApi apiInstance = new UtilisateursApi(defaultClient);
    InlineObject inlineObject = new InlineObject(); // InlineObject | 
    try {
      apiInstance.utilisateursPost(inlineObject);
    } catch (ApiException e) {
      System.err.println("Exception when calling UtilisateursApi#utilisateursPost");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **inlineObject** | [**InlineObject**](InlineObject.md)|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**201** | Utilisateur créé |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

<a name="utilisateursUserIdDelete"></a>
# **utilisateursUserIdDelete**
> utilisateursUserIdDelete(userId)

Supprimer un utilisateur

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UtilisateursApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    UtilisateursApi apiInstance = new UtilisateursApi(defaultClient);
    Long userId = 1L; // Long | 
    try {
      apiInstance.utilisateursUserIdDelete(userId);
    } catch (ApiException e) {
      System.err.println("Exception when calling UtilisateursApi#utilisateursUserIdDelete");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **Long**|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Utilisateur supprimé. |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |
**404** | L&#39;utilisateur est introuvable. |  -  |

<a name="utilisateursUserIdGet"></a>
# **utilisateursUserIdGet**
> Utilisateurs utilisateursUserIdGet(userId)

Retourne les détails d&#39;un utilisateur

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UtilisateursApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    UtilisateursApi apiInstance = new UtilisateursApi(defaultClient);
    Long userId = 1L; // Long | 
    try {
      Utilisateurs result = apiInstance.utilisateursUserIdGet(userId);
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling UtilisateursApi#utilisateursUserIdGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **Long**|  |

### Return type

[**Utilisateurs**](Utilisateurs.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Tableau JSON d&#39;un utilisateur |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

<a name="utilisateursUserIdPut"></a>
# **utilisateursUserIdPut**
> utilisateursUserIdPut(userId, inlineObject1)

Modifier un utilisateur

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.UtilisateursApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    UtilisateursApi apiInstance = new UtilisateursApi(defaultClient);
    Long userId = 1L; // Long | 
    InlineObject1 inlineObject1 = new InlineObject1(); // InlineObject1 | 
    try {
      apiInstance.utilisateursUserIdPut(userId, inlineObject1);
    } catch (ApiException e) {
      System.err.println("Exception when calling UtilisateursApi#utilisateursUserIdPut");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userId** | **Long**|  |
 **inlineObject1** | [**InlineObject1**](InlineObject1.md)|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**201** | Utilisateur modifié |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |
**404** | Utilisateur introuvable, vérifié l&#39;UserID |  -  |

